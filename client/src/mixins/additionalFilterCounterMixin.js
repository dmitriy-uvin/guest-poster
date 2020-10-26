export default {
    data: () => ({
        trustFilterCounter: 0,
        mozFilterCounter: 0,
        alexaFilterCounter: 0,
        ahrefsFilterCounter: 0,
        majesticFilterCounter: 0,
        semRushFilterCounter: 0,
        facebookFilterCounter: 0
    }),
    watch: {
        'filter.trust': {
            handler() {
                this.trustFilterCounter = 0;
                let result = 0;
                Object.keys(this.filter.trust).map(key => {
                    if (key.includes('_from')) {
                        const keyPrefix = key.split('_from')[0];
                        const keyFrom = keyPrefix + '_from';
                        const keyTo = keyPrefix + '_to';
                        if (this.filter.trust[keyFrom] && this.filter.trust[keyTo]) {
                            result += 1
                        } else if (this.filter.trust[keyFrom] && !this.filter.trust[keyTo]) {
                            result += 1;
                        } else if (!this.filter.trust[keyFrom] && this.filter.trust[keyTo]) {
                            result += 1;
                        }
                    }
                });
                this.trustFilterCounter = result;
                Object.keys(this.filter.trust).map(key => {
                    if (key === 'summary' && this.filter.trust.summary.length) {
                        this.trustFilterCounter += 1;
                    }
                });
            },
            deep: true
        },
        'filter.moz': {
            handler() {
                this.mozFilterCounter = 0;
                let result = 0;
                Object.keys(this.filter.moz).map(key => {
                    if (key.includes('_from')) {
                        const keyPrefix = key.split('_from')[0];
                        const keyFrom = keyPrefix + '_from';
                        const keyTo = keyPrefix + '_to';
                        if (this.filter.moz[keyFrom] && this.filter.moz[keyTo]) {
                            result += 1
                        } else if (this.filter.moz[keyFrom] && !this.filter.moz[keyTo]) {
                            result += 1;
                        } else if (!this.filter.moz[keyFrom] && this.filter.moz[keyTo]) {
                            result += 1;
                        }
                    }
                });
                this.mozFilterCounter = result;
            },
            deep: true
        },
        'filter.alexa': {
            handler() {
                this.alexaFilterCounter = 0;
                let result = 0;

                Object.keys(this.filter.alexa).map(key => {
                    if (key.includes('_from')) {
                        const keyPrefix = key.split('_from')[0];
                        const keyFrom = keyPrefix + '_from';
                        const keyTo = keyPrefix + '_to';
                        if (this.filter.alexa[keyFrom] && this.filter.alexa[keyTo]) {
                            result += 1
                        } else if (this.filter.alexa[keyFrom] && !this.filter.alexa[keyTo]) {
                            result += 1;
                        } else if (!this.filter.alexa[keyFrom] && this.filter.alexa[keyTo]) {
                            result += 1;
                        }
                    }
                });
                this.alexaFilterCounter = result;
            },
            deep: true
        },
        'filter.ahrefs': {
            handler() {
                this.ahrefsFilterCounter = 0;
                let result = 0;
                Object.keys(this.filter.ahrefs).map(key => {
                    if (key.includes('_from')) {
                        const keyPrefix = key.split('_from')[0];
                        const keyFrom = keyPrefix + '_from';
                        const keyTo = keyPrefix + '_to';
                        if (this.filter.ahrefs[keyFrom] && this.filter.ahrefs[keyTo]) {
                            result += 1
                        } else if (this.filter.ahrefs[keyFrom] && !this.filter.ahrefs[keyTo]) {
                            result += 1;
                        } else if (!this.filter.ahrefs[keyFrom] && this.filter.ahrefs[keyTo]) {
                            result += 1;
                        }
                    }
                });
                this.ahrefsFilterCounter = result;
            },
            deep: true
        },
        'filter.majestic': {
            handler() {
                this.majesticFilterCounter = 0;
                let result = 0;
                Object.keys(this.filter.majestic).map(key => {
                    if (key.includes('_from')) {
                        const keyPrefix = key.split('_from')[0];
                        const keyFrom = keyPrefix + '_from';
                        const keyTo = keyPrefix + '_to';
                        if (this.filter.majestic[keyFrom] && this.filter.majestic[keyTo]) {
                            result += 1
                        } else if (this.filter.majestic[keyFrom] && !this.filter.majestic[keyTo]) {
                            result += 1;
                        } else if (!this.filter.majestic[keyFrom] && this.filter.majestic[keyTo]) {
                            result += 1;
                        }
                    }
                });
                this.majesticFilterCounter = result;
            },
            deep: true
        },
        'filter.semRush': {
            handler() {
                this.semRushFilterCounter = 0;
                let result = 0;
                Object.keys(this.filter.semRush).map(key => {
                    if (key.includes('_from')) {
                        const keyPrefix = key.split('_from')[0];
                        const keyFrom = keyPrefix + '_from';
                        const keyTo = keyPrefix + '_to';
                        if (this.filter.semRush[keyFrom] && this.filter.semRush[keyTo]) {
                            result += 1
                        } else if (this.filter.semRush[keyFrom] && !this.filter.semRush[keyTo]) {
                            result += 1;
                        } else if (!this.filter.semRush[keyFrom] && this.filter.semRush[keyTo]) {
                            result += 1;
                        }
                    }
                });
                this.semRushFilterCounter = result;
            },
            deep: true
        },
        'filter.facebook': {
            handler() {
                this.facebookFilterCounter = 0;
                let result = 0;
                Object.keys(this.filter.facebook).map(key => {
                    if (key.includes('_from')) {
                        const keyPrefix = key.split('_from')[0];
                        const keyFrom = keyPrefix + '_from';
                        const keyTo = keyPrefix + '_to';
                        if (this.filter.facebook[keyFrom] && this.filter.facebook[keyTo]) {
                            result += 1
                        } else if (this.filter.facebook[keyFrom] && !this.filter.facebook[keyTo]) {
                            result += 1;
                        } else if (!this.filter.facebook[keyFrom] && this.filter.facebook[keyTo]) {
                            result += 1;
                        }
                    }
                });
                this.facebookFilterCounter = result;
            },
            deep: true
        }
    },
}