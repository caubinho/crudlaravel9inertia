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
    plan: {
        type: Object,
        default: () => ({}),
    },
    details: {
        type: Object,
        default: () => ({}),
    },
    processing : false,
});


function destroy(idPlan, idDetail) {

    this.processing = true;

      if (confirm("Are you sure you want to Delete")) {
        Inertia.delete(route('detail.plan.destroy', [ idPlan, idDetail ]));
        }
}

</script>
<template>
    <Head title="Detalhes do Plano" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Detalhes do Plano - {{ props.plan.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <!-- flash message start -->
                        <input-message type="success" :message="$page.props.flash.message" />
                        <!-- flash message end -->

                        <div class="mb-2">
                            <Link :href="route('detail.plan.create', props.plan.id)">
                                <BreezeButton>Add Detalhes</BreezeButton></Link>
                        </div>
                        <!-- input search -->

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
                                    v-for="detail in props.details"
                                    :key="detail.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                >

                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        {{ detail.name }}
                                    </th>

                                    <td class="px-6 py-4">
                                        {{ detail.created_at }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <Link
                                            :href="route('detail.plan.edit', [ props.plan.id, detail.id] )"
                                            class="px-4 py-2 text-white bg-blue-600 rounded-lg" >Editar</Link>
                                    </td>


                                    <td class="px-6 py-4">
                                        <BreezeButton
                                            class="bg-red-600"
                                            @click="destroy(props.plan.id, detail.id)"
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

        </div>
    </BreezeAuthenticatedLayout>
</template>

