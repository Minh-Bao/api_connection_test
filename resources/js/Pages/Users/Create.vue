<template>
    <div class="px-4 sm:px-6 lg:px-8 shadow-xl border-4 m-8 p-4 ">
        <div class="sm:flex sm:items-center bg-yellow-400 p-8 px-8 w-full rounded-2xl shadow-xl">
            <div class="sm:flex-auto ">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Users</h1>
                <p class="mt-2 text-sm text-gray-700">create a user.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="index" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    list of users
                </a>
            </div>
        </div>

        <div class="w-full flex justify-center mt-8 ">
            <div class="w-50 p-4 bg-white rounded-2xl border-2 shadow-xl
            ">
                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">
                                These informations will be store safely.</p>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">
                                        firstname*
                                    </label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.firstname" type="text" name="firstname" id="firstname"
                                                autocomplete="firstname"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="janesmith" />
                                        </div>
                                        <div class="text-red-500" v-if="form.errors.firstname">{{ form.errors.firstname }}</div>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="lastname" class="block text-sm font-medium leading-6 text-gray-900">lastname
                                        *</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.lastname" type="text" name="lastname" id="lastname"
                                                autocomplete="lastname"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="Albert" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.lastname">{{ form.errors.firstname }}</div>
                                    </div>
                                </div>
                                <div class="sm:col-span-8">
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">email *</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.email" type="text" name="email" id="email" autocomplete="email"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="email" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.email">{{ form.errors.email }}</div>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="address1" class="block text-sm font-medium leading-6 text-gray-900">address1
                                        *</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.address1" type="text" name="address1" id="address1"
                                                autocomplete="address1"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="address1" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.address1">{{ form.errors.address1 }}</div>

                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="address2"
                                        class="block text-sm font-medium leading-6 text-gray-900">complementary adress
                                        information
                                    </label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.address2" type="text" name="address2" id="address2"
                                                autocomplete="address2"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="address2" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.address2">{{ form.errors.address2 }}</div>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="statut" class="block text-sm font-medium leading-6 text-gray-900">statut
                                        *</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.statut" type="text" name="statut" id="statut"
                                                autocomplete="statut"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="statut" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.statut">{{ form.errors.statut }}</div>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="company" class="block text-sm font-medium leading-6 text-gray-900">company
                                        *</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.company" type="text" name="company" id="company"
                                                autocomplete="company"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="company" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.company">{{ form.errors.company }}</div>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="city" class="block text-sm font-medium leading-6 text-gray-900">city *</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.city" type="text" name="city" id="city" autocomplete="city"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="city" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.city">{{ form.errors.city }}</div>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="zipcode" class="block text-sm font-medium leading-6 text-gray-900">zipcode
                                        *</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.zipcode" type="text" name="zipcode" id="zipcode"
                                                autocomplete="zipcode"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="zipcode" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.zipcode">{{ form.errors.zipcode }}</div>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">gender
                                        *</label>
                                    <div
                                        class="mt-2 flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <select
                                            class="rounded-xl block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            v-model="form.gender" name="gender" id="gender">
                                            <option value="M">Man</option>
                                            <option value="F">Women</option>
                                            <option value="N">No gender</option>
                                        </select>
                                    </div>
                                    <div class="text-red-500" v-if="errors.gender">{{ form.errors.gender }}</div>
                                </div>

                                <div class="col-span-full">
                                    <label for="country" class="block text-sm font-medium leading-6 text-gray-900">country
                                        *</label>
                                    <div
                                        class="mt-2 flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <select
                                            class="rounded-xl block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            v-model="form.country" name="country" id="country">
                                            <option value="FR">France</option>
                                            <option value="UK">Angleterre</option>
                                            <option value="US">USA</option>
                                        </select>
                                    </div>
                                    <div class="text-red-500" v-if="errors.country">{{ form.errors.country }}</div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">password
                                        *</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.password" type="text" name="password" id="password"
                                                autocomplete="password"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="password" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.password">{{ form.errors.password }}</div>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="company_siret"
                                        class="block text-sm font-medium leading-6 text-gray-900">company_siret *</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.company_siret" type="text" name="company_siret"
                                                id="company_siret" autocomplete="company_siret"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="company_siret" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.company_siret">{{ form.errors.company_siret }}
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="company_tva"
                                        class="block text-sm font-medium leading-6 text-gray-900">company_tva *</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.company_tva" type="text" name="company_tva" id="company_tva"
                                                autocomplete="company_tva"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="company_tva" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.company_tva">{{ form.errors.company_tva }}</div>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="billing_email"
                                        class="block text-sm font-medium leading-6 text-gray-900">billing_email</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input v-model="form.billing_email" type="text" name="billing_email"
                                                id="billing_email" autocomplete="billing_email"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="billing_email" />
                                        </div>
                                        <div class="text-red-500" v-if="errors.billing_email">{{ form.errors.billing_email }}
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <p>* Fields required for a new user</p>
                                </div>
                            </div>
                        </div>


                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Notifications</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">We'll always let you know about important changes,
                                but you pick what else you want to know about.</p>

                            <div class="mt-10 space-y-10">
                                <fieldset>
                                    <legend class="text-sm font-semibold leading-6 text-gray-900">Check the box </legend>
                                    <div class="mt-6 space-y-5">
                                        <div class="relative flex gap-x-3">
                                            <div class="flex h-6 items-center">
                                                <input v-model="form.confirmed" id="confirmed" name="confirmed" type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                            </div>
                                            <div class="text-red-500" v-if="errors.confirmed">{{ form.errors.confirmed }}</div>
                                            <div class="text-sm leading-8">
                                                <label for="confirmed" class="font-medium text-gray-900">confirmed</label>
                                            </div>
                                        </div>
                                        <div class="relative flex gap-x-3">
                                            <div class="flex h-6 items-center">
                                                <input v-model="form.notify_ev" id="notify_ev" name="notify_ev" type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                            </div>
                                            <div class="text-red-500" v-if="errors.notify_ev">{{ form.errors.notify_ev }}</div>
                                            <div class="text-sm leading-6">
                                                <label for="notify_ev" class="font-medium text-gray-900">notify_ev</label>
                                            </div>
                                        </div>
                                        <div class="relative flex gap-x-3">
                                            <div class="flex h-6 items-center">
                                                <input v-model="form.notify_ar" id="notify_ar" name="notify_ar" type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                            </div>
                                            <div class="text-red-500" v-if="errors.notify_ar">{{ form.errors.notify_ar }}</div>
                                            <div class="text-sm leading-6">
                                                <label for="notify_ar" class="font-medium text-gray-900">notify_ar</label>
                                            </div>
                                        </div>
                                        <div class="relative flex gap-x-3">
                                            <div class="flex h-6 items-center">
                                                <input v-model="notify_ng" id="notify_ar" name="notify_ng" type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                            </div>
                                            <div class="text-red-500" v-if="errors.notify_ng">{{ form.errors.notify_ng }}</div>
                                            <div class="text-sm leading-6">
                                                <label for="notify_ng" class="font-medium text-gray-900">notify_ng</label>
                                            </div>
                                        </div>
                                        <div class="relative flex gap-x-3">
                                            <div class="flex h-6 items-center">
                                                <input v-model="notify_consent" id="notify_consent" name="notify_consent"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                            </div>
                                            <div class="text-red-500" v-if="errors.notify_consent">
                                                {{ form.errors.notify_consent }}</div>
                                            <div class="text-sm leading-6">
                                                <label for="notify_consent"
                                                    class="font-medium text-gray-900">notify_consent</label>
                                            </div>
                                        </div>
                                        <div class="relative flex gap-x-3">
                                            <div class="flex h-6 items-center">
                                                <input v-model="form.notify_eidas_to_valid" id="notify_eidas_to_valid"
                                                    name="notify_eidas_to_valid" type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                            </div>
                                            <div class="text-red-500" v-if="errors.notify_eidas_to_valid">
                                                {{ form.errors.notify_eidas_to_valid }}</div>
                                            <div class="text-sm leading-6">
                                                <label for="notify_eidas_to_valid"
                                                    class="font-medium text-gray-900">notify_eidas_to_valid</label>
                                            </div>
                                        </div>
                                        <div class="relative flex gap-x-3">
                                            <div class="flex h-6 items-center">
                                                <input v-model="form.notify_recipient_update" id="notify_recipient_update"
                                                    name="notify_recipient_update" type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                            </div>
                                            <div class="text-red-500" v-if="errors.notify_recipient_update">
                                                {{ form.errors.notify_recipient_update }}</div>
                                            <div class="text-sm leading-6">
                                                <label for="notify_recipient_update"
                                                    class="font-medium text-gray-900">notify_recipient_update</label>
                                            </div>
                                        </div>
                                        <div class="relative flex gap-x-3">
                                            <div class="flex h-6 items-center">
                                                <input v-model="form.notify_waiting_ar_answer" id="notify_waiting_ar_answer"
                                                    name="notify_waiting_ar_answer" type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                            </div>
                                            <div class="text-red-500" v-if="errors.notify_waiting_ar_answer">
                                                {{ form.errors.notify_waiting_ar_answer }}</div>
                                            <div class="text-sm leading-6">
                                                <label for="notify_waiting_ar_answer"
                                                    class="font-medium text-gray-900">notify_waiting_ar_answer</label>
                                            </div>
                                        </div>
                                        <div class="relative flex gap-x-3">
                                            <div class="flex h-6 items-center">
                                                <input v-model="form.is_legal_entity" id="is_legal_entity"
                                                    name="is_legal_entity" type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                            </div>
                                            <div class="text-red-500" v-if="errors.is_legal_entity">
                                                {{ form.errors.is_legal_entity }}</div>
                                            <div class="text-sm leading-6">
                                                <label for="is_legal_entity"
                                                    class="font-medium text-gray-900">is_legal_entity</label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                        <button @click="submit" type="button"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { useForm } from '@inertiajs/vue3';

defineProps({
    errors: String
})


const form = useForm({
    firstname: null,
    lastname: null,
    email: null,
    address1: null,
    address2: null,
    statut: null,
    company: null,
    city: null,
    zipcode: null,
    gender: null,
    password: null,
    company_siret: null,
    company_tva: null,
    confirmed: 0,
    billing_email: null,
    notify_ev: 0,
    notify_ar: 0,
    notify_ng: 0,
    notify_consent: 0,
    notify_eidas_to_valid: 0,
    notify_recipient_update: 0,
    notify_waiting_ar_answer: 0,
    is_legal_entity: 0,
});


function submit() {
    axios.post('/user/store', form)
        .then(
            function (response) {
                alert(JSON.stringify(response.data.message))
            }
        ).catch(
            function (error) {
                alert(JSON.stringify(response.data.message))
            }
        )
}

</script>