<template>
    <modal name="reportConfessionModal" height="auto" transition="pop-out">
        <div>
            <h4 class="p-4 bg-gray-400 text-red-600">Why are you reporting this confession? Please be as detailed as possible</h4>
            <textarea class="w-full" rows="8" v-model="body" required="required"></textarea>
            <div class="flex justify-between items-center p-2 bg-gray-400">
                <a href="#" @click.prevent="hide()">&lt; Back</a>
                <button class="p-2 px-4 bg-blue-600 text-white rounded" @click.prevent="store()">
                    <span v-if="!loading">SUBMIT</span>
                    <span v-if="loading">Loading...</span>
                </button>
            </div>
        </div>
    </modal>
</template>
<script>
export default {
    props: ['id'],

    data() {
        return {
            'body': '',
            'loading': false,
        }
    },

    methods: {
        store() {
            this.loading = true;
            axios.post('/report-confession/' + this.id, {
                    body: this.body
                })
                .then(() => {
                    this.loading = false;
                    this.$toasted.success('Confession is reported successfully!');
                    this.body = '';
                    this.$modal.hide('reportConfessionModal');
                })
                .catch((err) => {
                    this.loading = false;
                })
        },
        hide() {
            this.$modal.hide('reportConfessionModal');
        }
    }
}

</script>
