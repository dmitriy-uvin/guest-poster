<template>
    <div>
        <span :class="colorClasses[keyString]" class="head">
            {{ keyNames[keyString] }}
        </span>
        <span>{{ CheckTrust === null ? 'N/A' : CheckTrust + ' CT' }}</span>
        <span>{{ CheckTrustSpam === null ? 'N/A' : CheckTrustSpam + ' CS' }}</span>
        <span>{{ PowerTrust === null ? 'N/A' : PowerTrust + ' PT' }}</span>
    </div>
</template>

<script>
export default {
    name: 'PlatformTrust',
    props: ['CheckTrust', 'CheckTrustSpam', 'PowerTrust'],
    data: () => ({
        threeCharacteristics: {
            'PPP': 'P',
            'GGG': 'G',
            'GPP': 'P',
            'BPP': 'G',
            'GGP': 'G',
            'BBP': 'G',
            'BGP': 'G',
            'BGG': 'G',
            'BBG': 'B',
            'BBB': 'B',
        },
        twoCharacteristics: {
            'PP': 'P',
            'GP': 'G',
            'BP': 'G',
            'GG': 'G',
            'BG': 'G',
            'BB': 'B',
        },
        keyNames: {
            'P': 'Perfect',
            'G': 'Good',
            'B': 'Bad',
            'N/A': 'N/A'
        },
        colorClasses: {
            'P': 'purple-text',
            'G': 'green--text',
            'B': 'red--text'
        }
    }),
    computed: {
        combinationKey() {
            let key = [];
            if (this.CheckTrust !== null) {
                if (this.CheckTrust >= 0 && this.CheckTrust <= 30) {
                    key.push('B');
                } else if (this.CheckTrust >= 31 && this.CheckTrust <= 50) {
                    key.push('G');
                } else if (this.CheckTrust >= 51 && this.CheckTrust <= 100) {
                    key.push('P');
                }
            }
            if (this.CheckTrustSpam !== null) {
                if (this.CheckTrustSpam >= 21 && this.CheckTrustSpam <= 100) {
                    key.push('B');
                } else if (this.CheckTrustSpam >= 6 && this.CheckTrustSpam <= 20) {
                    key.push('G');
                } else if (this.CheckTrustSpam >= 0 && this.CheckTrustSpam <= 5) {
                    key.push('P');
                }
            }

            if (this.PowerTrust !== null) {
                if (this.PowerTrust >= 0 && this.PowerTrust <= 10) {
                    key.push('B');
                } else if (this.PowerTrust >= 11 && this.PowerTrust <= 30) {
                    key.push('G');
                } else if (this.PowerTrust >= 31 && this.PowerTrust <= 100) {
                    key.push('P');
                }
            }

            return key.sort((a, b) => {
                if (a > b) return 1;
                if (a < b) return -1;
                return 0;
            }).join('');
        },
        keyString() {
            if (this.combinationKey.length === 3) return this.threeCharacteristics[this.combinationKey];
            if (this.combinationKey.length === 2) return this.twoCharacteristics[this.combinationKey];
            return 'N/A';
        }
    }
}
</script>

<style scoped>
span {
    display: block;
    margin-bottom: 3px;
}
.head {
    font-weight: bold;
    text-transform: uppercase;
}
.purple-text {
    color: #9B51E0;
}
</style>