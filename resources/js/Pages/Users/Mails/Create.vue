<template>
    <div >
        <div class="w-2/3 mx-auto shadow-2xl p-4">
            <Banner :key="componentKey" />
            <div class="sm:flex sm:items-center bg-yellow-400 py-4 px-8 w-full rounded-b-2xl pb-8 shadow-xl mb-8 ">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Mail</h1>
                    <p class="mt-2 text-sm text-gray-700">Send a mail</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <Link :href="route('user.index')"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        List user
                    </Link>
                </div>
            </div>

            <form @submit.prevent="submit">
                <div class="space-y-12 sm:space-y-16">
                    <div>
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Email</h2>
                        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-600">
                            Write and send email
                        </p>

                        <div
                            class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">
                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="custom_name_sender"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Custom sender name</label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input v-model="form.custom_name_sender" type="text" name="custom_name_sender" id="custom_name_sender" autocomplete="custom_name_sender"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="janesmith" />
                                    </div>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="to_lastname"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">to_lastname <span class="optional">*</span></label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input v-model="form.to_lastname" type="text" name="to_lastname" id="to_lastname" autocomplete="to_lastname"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="richard" />
                                    </div>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="to_firstname"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">to_firstname <span class="optional">*</span></label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input v-model="form.to_firstname" type="text" name="to_firstname" id="to_firstname" autocomplete="to_firstname"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="james" />
                                    </div>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="to_company"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">to_company <span class="required">*</span></label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input v-model="form.to_company" type="text" name="to_company" id="to_company" autocomplete="to_company"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="ABC.co" />
                                    </div>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="to_email"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">to_email *</label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input v-model="form.to_email" type="email" name="to_email" id="to_email" autocomplete="to_email"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="dest@email.com" />
                                    </div>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="dest_statut"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">dest_statut</label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <select  v-model="form.dest_statut" id="dest_statut" name="dest_statut" autocomplete="dest_statut"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option>particulier</option>
                                        <option>professionnel</option>
                                    </select>
                                </div>
                            </div>


                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="content"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Content</label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <textarea v-model="form.content" id="content" name="content" rows="3"
                                        class="block w-full max-w-2xl rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                    <p class="mt-3 text-sm leading-6 text-gray-600">Write your mail content here.</p>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="attachment"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Cover
                                    Attachment</label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <multiselect
                                        v-model="form.attachment"
                                        :options="options"
                                        :multiple="true"
                                        :close-on-select="true"
                                        placeholder="Pick some files"
                                    >
                                    </multiselect>                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button"  @click="submit"
                        class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>
  
<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import { ref } from 'vue';
import Multiselect from '@suadelabs/vue3-multiselect'
import axios from 'axios';

const componentKey = ref(0);

const props = defineProps({
    errors: String,
    user_id: Number,
    attachments: Array
})

const id_user = props.user_id;
const options = props.attachments;


const form = useForm({
    custom_name_sender: null,
    to_lastname: null,
    to_firstname: null,
    to_company: null,
    to_email: null,
    dest_statut: null,
    content: null,
    attachment: null,
});


function submit() {
    form.submit('post', "/users/"+ id_user +"/mail/send", {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: (e) => {
                componentKey.value += 1;
                form.reset();
            },
            onError: () => {
                componentKey.value += 1;
            }
        })
}
</script>
<style src="@suadelabs/vue3-multiselect/dist/vue3-multiselect.css"></style>