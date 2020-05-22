<template>
    <div>
        <form @submit.prevent="handleRegister()">
            <p class="mt-2 mb-4 text-center text-gray-600">To remain anonymous, only your username<br /> will be visible to everyone</p>
            <div class="flex flex-col">
                <label class="ml-3 mb-2 text-gray-800">Username</label>
                <input v-model="form.username" type="text" class="mb-3 p-2  border-2 rounded" placeholder="Username" />
                <has-error :form="form" field="username"></has-error>
            </div>
            <div class=" flex flex-col">
                <div class="flex justify-between">
                    <label class="ml-3 mb-2 text-gray-800">Password</label>
                    <a href="#" @click.prevent="showPassword()" class="mr-3 text-gray-800">
                        <span v-if="type == 'password'">
                            <i class="mr-2 fa fa-eye text-teal-600"></i>Show
                        </span>
                        <span v-if="type == 'text'">
                            <i class="mr-2 fa fa-eye text-teal-600"></i>Hide
                        </span>
                    </a>
                </div>
                <input v-model="form.password" type="password" class="mb-3 p-2 border-2 rounded" placeholder="Password" />
                <has-error :form="form" field="password"></has-error>
            </div>
            <div class=" flex flex-col">
                <div class="flex justify-between">
                    <label class="ml-3 mb-2 text-gray-800">Password Confirmation</label>
                    <a href="#" @click.prevent="showPassword()" class="mr-3 text-gray-800">
                        <span v-if="type == 'password'">
                            <i class="mr-2 fa fa-eye text-teal-600"></i>Show
                        </span>
                        <span v-if="type == 'text'">
                            <i class="mr-2 fa fa-eye text-teal-600"></i>Hide
                        </span>
                    </a>
                </div>
                <input v-model="form.password_confirmation" type="password" class="mb-3 p-2 border-2 rounded" placeholder="Password" />
                <has-error :form="form" field="password_confirmation"></has-error>
            </div>
            <div class="flex flex-col">
                <label class="ml-3 mb-2 text-gray-800">Email <i v-popover:email class="fa fa-question-circle-o cursor-pointer"></i> </label>
                <input v-model="form.email" type="email" class="mb-3 p-2  border-2 rounded" placeholder="Email" />
                <has-error :form="form" field="email"></has-error>
            </div>
            <div>
                <label class="text-gray-800">Birthday <i v-popover:birthday class="fa fa-question-circle-o cursor-pointer"></i></label>
                <div class="flex justify-between mt-3">
                    <div>
                        <select class="py-1 px-4 border rounded" v-model="form.month">
                            <option :value="index + 1" v-for="(month, index) in months">{{ month }}</option>
                        </select>
                    </div>
                    <div>
                        <select class="py-1 px-4 border rounded" v-model="form.day">
                            <option v-for="day in days" :value="day">{{ day }}</option>
                        </select>
                    </div>
                    <div>
                        <select class="mb-3 py-1 px-4 border rounded" v-model="form.year">
                            <option v-for="year in years" :value="year">{{ year }}</option>
                        </select>
                    </div>
                </div>
                <has-error :form="form" field="dob"></has-error>
            </div>
            <div class="mt-3">
                <label class="text-gray-800">Gender <i v-popover:gender class="fa fa-question-circle-o cursor-pointer"></i></label>
                <div class="flex justify-between mt-2">
                    <div>
                        <input v-model="form.gender" type="radio" name="gender" value="M" />
                        <label>Male</label>
                    </div>
                    <div>
                        <input v-model="form.gender" type="radio" name="gender" value="F" />
                        <label>Female</label>
                    </div>
                    <div>
                        <input v-model="form.gender" type="radio" name="gender" value="O" />
                        <label>Custom</label>
                    </div>
                    <has-error :form="form" field="gender"></has-error>
                </div>
            </div>
            <div class="mt-3">
                <div class="mt-3">
                    <input type="checkbox" name="terms_and_conditions" id="terms-accepted" v-model="form.terms_and_conditions">
                    <label for="terms-accepted">Agree to terms and conditions</label>
                    <has-error :form="form" field="terms_and_conditions"></has-error>
                </div>
            </div>
            <div class="mt-6 flex justify-between">
                <a href="/login" class="text-blue-600"><i class="fa fa-chevron-left"></i> Back to login </a>
                <button :disabled="form.busy" type="submit" class="py-2 px-4 bg-blue-600 text-white">
                    <i v-if="form.busy" class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>
                    Creat Account
                </button>
            </div>
        </form>
        <popover name="email" :width="280">
            “Why are you asking for my email?”: This is to be used only to verify that you are a real person. A verification will also be sent to this email. We will not be sending any spam. However, we might send notifications when required, such as changes to our privacy policy, terms and conditions etc
        </popover>
        <popover name="birthday" :width="280">
            “Why are you asking for my birthday?” Use of the Bulong website/service is only for people age 18+ so we need this to verify your age
        </popover>
        <popover name="gender" :width="280">
            “Why are you asking for my gender?” This is for demographic purposes only. Feel free to select “Others/Prefer not to say” if you don’t want to share this information
        </popover>
    </div>
</template>
<script>
import Popover from 'vue-js-popover'
Vue.use(Popover)
export default {
    data() {
        return {
            type: 'password',
            form: new Form({
                username: '',
                password: '',
                password_confirmation: '',
                email: '',
                month: '',
                day: '',
                year: '',
                gender: '',
                city_id: 1,
                terms_and_conditions: ''
            })
        }
    },

    methods: {
        handleRegister() {
            this.form.post('/register')
                .then(() => {
                    // Vue.$toast.open('Success! Redirecting...');
                    setTimeout(function() {
                        window.location.href = '/';
                    }, 1000)
                })
                .catch(() => {
                    //
                })
        },

        showPassword() {
            if (this.type === 'password') {
                this.type = 'text';
            } else {
                this.type = 'password';
            }
        }
    },

    computed: {
        months() {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            return months;
        },

        days() {
            let days = [];
            for (let day = 1; day <= 31; day++) {
                days.push(day);
            }
            console.log(days);
            return days;
        },

        years() {
            const currentYear = new Date().getFullYear();
            const startYear = currentYear - 80;
            let years = [];

            for (let year = startYear; year <= currentYear; year++) {
                years.push(year);
            }

            return years;
        }
    }
}

</script>
<style>
.vue-popover {
    background: #444;
    color: #f9f9f9;
    font-size: 12px;
    line-height: 1.5;
    margin: 5px;
}

</style>
