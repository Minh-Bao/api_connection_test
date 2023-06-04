<template>
    <div class="px-4 sm:px-6 lg:px-8 bg-white shadow-xl border-4 m-8 ">
        <Banner :key="componentKey" />
        <div class="sm:flex sm:items-center bg-yellow-400 py-4 px-8 w-full rounded-b-2xl pb-8 shadow-xl ">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Users</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all the users.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="create"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
                    user</a>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">
                                    Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Company
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Activity
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Attachment
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Mail</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="user in people" :key="user.email">
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                    <Link :href="`/users/${user.id}`" class="hover:bg-indigo-600 hover:text-white text-indigo-700">
                                    {{ user.name }}</Link>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.email }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.company }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.company_activity }}
                                </td>
                                <td
                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-left text-sm font-medium sm:pr-6 lg:pr-8">
                                    <form @submit.prevent="submit(user.id)">
                                        <input @input="form.attachment = $event.target.files[0]" type="file"
                                            class="text-indigo-600 hover:text-indigo-900" />
                                        <button @click="submit(user.id)" type="button"
                                            class="bg-indigo-500 text-white hover:bg-indigo-300 hover:text-gray-500 p-4 rounded-xl">
                                            upload
                                        </button>
                                    </form>
                                </td>
                                <td class="whitespace-nowrap px- py-4  text-sm text-gray-500">
                                    <Link :href="`/users/mail/send`"
                                        class=" py-4 px-8 text-gray-800 hover:bg-yellow-500 bg-yellow-300 rounded-xl">Create
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import Banner from '@/Components/Banner.vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const componentKey = ref(0);

const props = defineProps({
    users: Array
})

const form = useForm({
    attachment: null,
    user_id: null
});

function submit(id) {
    form.transform((data) => ({ ...data, user_id: id }))
        .submit('post', '/users/attachment/upload', {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                componentKey.value += 1;
            },
            onError: () => {
                componentKey.value += 1;
            }
        })
}
const people = props.users
</script>