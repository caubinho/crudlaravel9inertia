<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/Button.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import InputMessage from "@/Components/InputMessage.vue";
import { ref } from "vue";
import { watch } from "vue";
import Pagination from "@/Components/Pagination.vue";


const props = defineProps({
    datos: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },

});

// pass filters in search
let search = ref(props.filters.search);

watch(search, (value) => {
    if(value){
        Inertia.get(
            route('permission.index'),
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    }
});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        Inertia.delete(route("permissions.destroy", id));
    }
}

</script>
<template>
    <Head title="Permissões" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Permissions
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <!-- flash message start -->
                        <input-message type="success" :message="$page.props.flash.message" />
                        <!-- flash message end -->
                        <!-- flash message start -->
                        <input-message type="error" :message="$page.props.errors.message" />
                        <!-- flash message end -->

                        <div class="mb-2">
                            <Link :href="route('permissions.create')">
                                <BreezeButton>Add Permissão</BreezeButton></Link>
                        </div>
                        <!-- input search -->
                        <div class="mb-2 mt-2">
                            <input
                                type="text"
                                v-model="search"
                                placeholder="Search..."
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5"
                            />
                        </div>
                        <!-- input search end -->

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>


                                    <th scope="col" class="px-6 py-3">
                                        Nome
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Data Cadastro
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Editar
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Excluir
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr
                                    v-for="dato in datos.data"
                                    :key="dato.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                    >
                                    <td class="px-6 py-4">
                                        {{ dato.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ dato.created_at }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <Link
                                            :href="
                                                    route(
                                                        'permissions.edit',
                                                        dato.id
                                                    )
                                                "
                                            class="px-4 py-2 text-white bg-blue-600 rounded-lg" >Editar</Link>
                                    </td>


                                    <td class="px-6 py-4">
                                        <BreezeButton
                                            class="bg-red-600"
                                            @click="destroy(dato.id)"
                                        >
                                            Delete
                                        </BreezeButton>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <Pagination :data="datos" />
        </div>
    </BreezeAuthenticatedLayout>
</template>

