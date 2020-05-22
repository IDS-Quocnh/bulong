<template>
    <div class="p-4 flex justify-center items-center">
        <ul class="text-center">
            <li class="mb-2 hover:text-blue-600">
                <a href="#" @click.prevent="showReportConfessionModal(id)">Report Confession</a>
            </li>
            <li class="mb-2 hover:text-blue-600" v-if="page == 'index'">
                <a href="#" @click.prevent="showConfession(id)">Go to Post</a>
            </li>
            <li class="mb-2 hover:text-blue-600">
                <a href="#">Share</a>
            </li>
            <li class="mb-2 hover:text-blue-600">
                <a href="#" v-clipboard:copy="confessionUrl" v-clipboard:success="onCopy">Copy link</a>
            </li>
            <!-- <li class="mb-2 hover:text-blue-600">
                <a href="#">Unfollow</a>
            </li> -->
            <li class="mb-2 hover:text-blue-600" v-if="$gate.userId() == userId">
                <a href="#" @click.prevent="editConfession(id)">Edit</a>
            </li>
            <li class="mb-2 hover:text-blue-600" v-if="$gate.userId() == userId">
                <a href="#" @click.prevent="deleteConfession(id)">Delete</a>
            </li>
            <li class="mb-2 hover:text-blue-600">
                <a href="#" @click.prevent="hideModal()">Cancel</a>
            </li>
        </ul>
        <report-confession-modal :id="id"></report-confession-modal>
    </div>
</template>
<script>
import ReportConfessionModal from './ReportConfessionModal'
import VueClipboard from 'vue-clipboard2'
Vue.use(VueClipboard)

export default {
    components: {
        ReportConfessionModal
    },

    props: ['id', 'userId', 'page'],

    data() {
        return {
            confessionUrl: rootUrl + '/confessions/' + this.id
        }
    },

    methods: {
        showReportConfessionModal(id) {
            this.$modal.show('reportConfessionModal')
        },

        reportConfession(id) {
            axios.post('/report-confession/' + id)
                .then(() => {
                    console.log('reported');
                })
        },

        showConfession(id) {
            window.location.href = `/confessions/${id}`
        },

        editConfession(id) {
            Fire.$emit('EditConfession', id)
            this.hideModal()
            window.scrollTo(0, 0, 'smooth')
        },

        deleteConfession(id) {
            this.hideModal()
            this.$modal.show('dialog', {
                title: 'Alert!',
                text: 'Are you sure you want to delete?',
                buttons: [{
                        title: 'Yes',
                        handler: () => {
                            this.$store.dispatch('deleteConfession', id);
                            this.$modal.hide('dialog')
                            this.hideModal()
                            if (this.page == 'confessionDetail') {
                                setTimeout(function() {
                                    window.location.href = '/'
                                }, 1000)
                            }
                        }
                    },
                    {
                        title: '', // Button title
                        default: true, // Will be triggered by default if 'Enter' pressed.
                        handler: () => {} // Button click handler
                    },
                    {
                        title: 'Close'
                    }
                ]
            })
        },

        copyLink(id) {
            this.$toasted.success('Link copied successfully!');
        },

        onCopy: function(e) {
            this.$toasted.success('Link copied successfully!');
        },

        hideModal() {
            this.$modal.hide(this.$parent.name)
        }
    },

    created() {
        console.log(this.id);
    }
}

</script>
