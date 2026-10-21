// resources/js/components/dateTimePicker.js

export default (config = {}) => ({
    value: '',
    dateValue: '',
    timeValue: '',
    timezoneOffset: '',
    initialized: false,

    init() {
        // x-model.fill may populate value after init,
        // so we defer sync until value is available.
    },

    hasDate() {
        return !!config.hasDate;
    },

    hasTime() {
        return !!config.hasTime;
    },

    hiddenInput() {
        return this.$refs[config.hiddenInputRef];
    },

    syncTextToPickers(value) {
        this.timezoneOffset = this.resolveTimezoneOffset(value);

        const [dateValue, timeValue] = this.parseValue(value);

        this.dateValue = this.hasDate() ? (dateValue || '') : '';
        this.timeValue = this.hasTime() ? (timeValue || '') : '';

        this.value = this.formatValue(
            this.dateValue,
            this.timeValue,
            this.timezoneOffset
        );

        const hiddenInput = this.hiddenInput();

        if (hiddenInput) {
            hiddenInput.value = this.value;
        }

        if (this.dateValue) {
            this.$nextTick(() => this.syncDatePicker());
        }

        if (this.timeValue) {
            this.$nextTick(() => this.syncTimePicker());
        }
    },

    onDateChange(event) {
        this.dateValue = event.target?.value ?? this.dateValue;
        this.syncPickersToText();
    },

    onTimeChange(event) {
        this.timeValue = event.target?.value ?? this.timeValue;
        this.syncPickersToText();
    },

    syncDatePicker() {
        if (!this.hasDate()) {
            return;
        }

        const datePicker = this.$el.querySelector('flux-date-picker');

        if (!datePicker || !this.dateValue) {
            return;
        }

        const [year, month, day] = this.dateValue.split('-').map(Number);

        const parsed = new Date(
            Date.UTC(year, month - 1, day)
        );

        if (
            !Number.isFinite(parsed.getTime()) ||
            parsed.getUTCFullYear() !== year ||
            parsed.getUTCMonth() !== month - 1 ||
            parsed.getUTCDate() !== day
        ) {
            return;
        }

        datePicker.setAttribute('value', this.dateValue);

        datePicker.dispatchEvent(
            new Event('input', { bubbles: true })
        );

        datePicker.dispatchEvent(
            new Event('change', { bubbles: true })
        );
    },

    syncTimePicker() {
        if (!this.hasTime()) {
            return;
        }

        const timePicker = this.$el.querySelector('flux-time-picker');

        if (!timePicker || !this.timeValue) {
            return;
        }

        timePicker.setAttribute(
            'value',
            this.normaliseTimeValue(this.timeValue)
        );

        timePicker.dispatchEvent(
            new Event('input', { bubbles: true })
        );

        timePicker.dispatchEvent(
            new Event('change', { bubbles: true })
        );
    },

    syncPickersToText() {
        const dateValue = this.hasDate() ? this.dateValue : '';
        const timeValue = this.hasTime() ? this.timeValue : '';

        const combined = this.formatValue(
            dateValue,
            timeValue,
            this.timezoneOffset
        );

        this.value = combined;

        const hiddenInput = this.hiddenInput();

        if (!hiddenInput) {
            return;
        }

        hiddenInput.value = combined;

        hiddenInput.dispatchEvent(
            new Event('input', { bubbles: true })
        );
    },

    resolveTimezoneOffset(value) {
        const trimmed = (value || '').trim();

        if (!trimmed) {
            return this.timezoneOffset || '+00:00';
        }

        const offsetMatch = trimmed.match(
            /(?:GMT|UTC)?([+-]\d{1,2}:\d{2}|[+-]\d{4}|Z)$/i
        );

        if (offsetMatch) {
            return this.normaliseOffset(offsetMatch[1]);
        }

        return this.timezoneOffset || '+00:00';
    },

    getLondonTimeOffset() {
        if (!this.dateValue) {
            return '+00:00';
        }

        const [year, month, day] = this.dateValue
            .split('-')
            .map(Number);

        if ([year, month, day].some(Number.isNaN)) {
            return '+00:00';
        }

        const londonDate = new Date(
            Date.UTC(year, month - 1, day, 12)
        );

        return this.isBritishSummerTime(londonDate)
            ? '+01:00'
            : '+00:00';
    },

    isBritishSummerTime(date) {
        const year = date.getUTCFullYear();

        const start = new Date(Date.UTC(year, 2, 31));

        start.setUTCDate(
            start.getUTCDate() -
            ((start.getUTCDay() + 7) % 7)
        );

        const end = new Date(Date.UTC(year, 9, 31));

        end.setUTCDate(
            end.getUTCDate() -
            ((end.getUTCDay() + 7) % 7)
        );

        return date >= start && date < end;
    },

    normaliseOffset(offset) {
        if (!offset) {
            return '';
        }

        const cleaned = offset.toUpperCase();

        if (cleaned === 'Z') {
            return '+00:00';
        }

        const match = cleaned.match(
            /^(GMT|UTC)?([+-])(\d{1,2})(?::?(\d{2}))?$/i
        );

        if (match) {
            const sign = match[2];
            const hours = String(match[3]).padStart(2, '0');
            const minutes = String(
                match[4] || '00'
            ).padStart(2, '0');

            return `${sign}${hours}:${minutes}`;
        }

        return offset;
    },

    formatValue(
        dateValue,
        timeValue,
        offset = this.timezoneOffset
    ) {
        if (!dateValue && !timeValue) {
            return '';
        }

        const resolvedOffset = this.normaliseOffset(
            offset || this.getLondonTimeOffset()
        );

        const timePart = timeValue
            ? this.normaliseTimeValue(timeValue)
            : '';

        const datePart = dateValue || '';

        if (this.hasDate() && this.hasTime()) {
            const datetime = timePart
                ? `${datePart}T${timePart}`
                : datePart;

            return datetime
                ? `${datetime}${resolvedOffset}`
                : '';
        }

        if (this.hasDate()) {
            return datePart
                ? `${datePart}${resolvedOffset}`
                : '';
        }

        if (this.hasTime()) {
            return timePart
                ? `${timePart}${resolvedOffset}`
                : '';
        }

        return '';
    },

    normaliseTimeValue(value) {
        if (!value) {
            return '';
        }

        const parts = value.split(':');

        if (parts.length === 2) {
            return `${String(parts[0]).padStart(2, '0')}:${String(parts[1]).padStart(2, '0')}:00`;
        }

        if (parts.length >= 3) {
            return `${String(parts[0]).padStart(2, '0')}:${String(parts[1]).padStart(2, '0')}:${String(parts[2]).padStart(2, '0')}`;
        }

        return value;
    },

    initSync() {
        if (!this.initialized && this.value) {
            this.timezoneOffset = this.resolveTimezoneOffset(
                this.value
            );

            this.syncTextToPickers(this.value);

            this.initialized = true;
        }
    },

    parseValue(value) {
        const trimmed = (value || '').trim();

        const baseValue = this.stripTimezoneSuffix(trimmed);

        if (!baseValue) {
            return ['', ''];
        }

        const iso = Date.parse(baseValue);

        if (!Number.isNaN(iso)) {
            const date = new Date(baseValue);

            const year = date.getFullYear();
            const month = String(
                date.getMonth() + 1
            ).padStart(2, '0');

            const day = String(
                date.getDate()
            ).padStart(2, '0');

            const hours = String(
                date.getHours()
            ).padStart(2, '0');

            const minutes = String(
                date.getMinutes()
            ).padStart(2, '0');

            return [
                `${year}-${month}-${day}`,
                `${hours}:${minutes}`,
            ];
        }

        const parts = baseValue.split(/\s+/);

        if (parts.length === 1) {
            return this.isTime(parts[0])
                ? ['', parts[0]]
                : [parts[0], ''];
        }

        return [
            parts[0],
            parts.slice(1).join(' '),
        ];
    },

    stripTimezoneSuffix(value) {
        if (!value) {
            return '';
        }

        return value.replace(
            /\s*(?:GMT|UTC)?([+-]\d{1,2}(?::?\d{2})?|Z)$/i,
            ''
        ).trim();
    },

    isTime(value) {
        return /^\d{1,2}:\d{2}(:\d{2})?$/.test(value);
    },
});