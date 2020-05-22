<template>
    <div>
        <button class="btn btn-danger mb-3" @click.prevent="deleteAccount()">Delete Account</button>
    </div>
</template>
<script>
import Swal from 'sweetalert2'
export default {
    data() {
        //
    },

    methods: {
        deleteAccount() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                html: `
                <ul class="text-left list-unstyled">
                    <li>
                        >> Your profile, photos, comments, feels and followers will be permanently removed.
                    </li>
                    <li class="my-3">
                        >> You can't sign up again with the same username or add that username to another account.
                    </li>
                    <li>
                        >> Deleted accounts cannot be reactivated
                    </li>
                </ul>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.delete(`/accounts/${user.id}/delete`)
                        .then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Your account has been deleted.',
                                'success'
                            )
                        })
                }
            })
        }
    }
}

</script>
