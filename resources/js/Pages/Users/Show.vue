<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl border-4 m-6 rounded-lg p-6 ">
            <div class="sm:flex sm:items-center bg-yellow-400 p-6 rounded-2xl shadow-xl">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">User</h1>
                    <p class="mt-2 text-sm text-gray-700">Information on the user.</p>
                </div>
                <div>
                    <div class="mt-4 mb-6 sm:ml-16 sm:mt-0 sm:flex-none ">
                        <a href="create"
                            class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Add user
                        </a>
                    </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a href="index"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        List user
                    </a>
                </div>
            </div>
        </div>

            <div class="text-center mb-8 border-b-4 pb-4 mt-8">
                <h2 class="text-2xl capitalize  font-bold">{{ current_user.name }}</h2>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-500">Contact Information</h3>
                    <ul class="mt-2">
                        <li><span class="font-semibold">Email:</span> {{ current_user.email }}</li>
                        <li><span class="font-semibold">Country:</span> {{ current_user.country }}</li>
                        <li><span class="font-semibold">Address:</span> {{ current_user.address1 }}</li>
                        <li><span class="font-semibold">Complentary Adress:</span> {{ current_user.address2 }}</li>
                        <li><span class="font-semibold">City:</span> {{ current_user.city }}</li>
                        <li><span class="font-semibold">Zipcode:</span> {{ current_user.zipcode }}</li>
                        <li><span class="font-semibold">Phone:</span> {{ current_user.c_phone }}</li>
                        <li><span class="font-semibold">Mobilephone:</span> {{ current_user.c_mobile }}</li>
                        <li><span class="font-semibold">Created:</span> {{ current_user.creation }}</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-500">Compagny Information</h3>
                    <ul class="mt-2">
                        <li><span class="font-semibold">Company:</span> {{ current_user.company }}</li>
                        <li><span class="font-semibold">Compagny actiivity:</span> {{ current_user.company_activity }}</li>
                        <li><span class="font-semibold">Compagny siret:</span> {{ current_user.company_siret }}</li>
                        <li><span class="font-semibold">Compagny tva:</span> {{ current_user.company_tva }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    user: Array
});

const current_user = props.user;


</script>
  
  