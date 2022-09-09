<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/Button.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
    datos: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    id: props.datos.id,
    name: props.datos.name,
    email: props.datos.email,
    password: props.datos.password
});

const submit = () => {
    console.log(form);
    form.put(route('users.update', props.datos.id));
};
</script>

<template>
    <Head title="Editar Usuário" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="grid grid-cols-10  gap-4">
                <div class="col-span-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Editar Usuário - <strong>{{ this.props.datos.name }}</strong>
                    </h2>
                </div>
                <div class="col-end-12 sm:col-end-10">
                    <Link :href="route('users.index')" class="bg-blue-600  hover:bg-blue-500 text-white  font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        Volver
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">



                        <div class="mt-10 sm:mt-0">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">Informaciones Personales</h3>
                                        <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                                    </div>
                                </div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <form @submit.prevent="submit">
                                        <div class="mb-6">
                                            <label
                                                for="Name"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >Name</label
                                            >
                                            <input
                                                type="text"
                                                v-model="form.name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                                            />
                                            <div v-if="form.errors.name" class="text-red-600 text-sm">{{ form.errors.name }}</div>
                                        </div>
                                        <div class="mb-6">
                                            <label
                                                for="slug"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >Email</label
                                            >
                                            <input
                                                type="text"
                                                v-model="form.email"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                                            />
                                            <div v-if="form.errors.email" class="text-red-600 text-sm">{{ form.errors.email }}</div>
                                        </div>

                                        <div class="mb-6">
                                            <label
                                                for="slug"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >Senha</label
                                            >
                                            <input
                                                type="password"
                                                v-model="form.password"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                                            />
                                            <div v-if="form.errors.password" class="text-red-600 text-sm">{{ form.errors.password }}</div>
                                        </div>

                                        <BreezeButton
                                            type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            :disabled="form.processing"
                                            :class="{ 'opacity-25': form.processing }"
                                        >
                                            Enviar
                                        </BreezeButton>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <div class="hidden sm:block" aria-hidden="true">
                            <div class="py-5">
                                <div class="border-t border-gray-200" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
