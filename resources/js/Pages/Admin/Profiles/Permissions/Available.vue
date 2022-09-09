<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/Button.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import InputMessage from "@/Components/InputMessage.vue";
import { useForm } from '@inertiajs/inertia-vue3'


const props = defineProps({
    profile: {
        type: Object,
        default: () => ({}),
    },
    permissions: Object,
        default:() => ({}),
});

const form = useForm({
    permissions: [],
});


const submit = () => {
    form.post(route('profile.permissions.attach', props.profile.id));
};

</script>
<template>
    <Head title="Permissões Disponiveis" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Permissões Disponiveis para o perfil - {{ props.profile.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">


                        <div class="mb-2">
                            <Link :href="route('profile.permissions', props.profile.id)">
                                <BreezeButton>Voltar</BreezeButton></Link>
                        </div>


                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">


                            <!-- flash message start -->
                            <input-message type="success" :message="$page.props.flash.message" />
                            <!-- flash message end -->

                            <form @submit.prevent="submit">

                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-3">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        #
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Nome
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr
                                    v-for="permission in props.permissions.data"
                                    :key="permission.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        <input
                                            :id="permission.is" :value="permission.id"
                                            v-model="form.permissions"
                                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="" id="flexCheckDefault">
                                    </th>
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        {{ permission.name }}
                                    </th>

                                </tr>



                                </tbody>

                            </table>

                                <div class="m-5 float-right">
                                <BreezeButton
                                    type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    :disabled="form.processing"
                                    :class="{ 'opacity-25': form.processing }"
                                >
                                    Vincular
                                </BreezeButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </BreezeAuthenticatedLayout>
</template>

