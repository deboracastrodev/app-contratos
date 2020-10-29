<template>

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Gestão de Propriedades
            </h1>
        </div>
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">

            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            E-mail</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Endereço</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 bg-gray-50"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="property in properties" :key="property.id">
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ property.id }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ property.email_property }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ property.street }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ property.status }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                            <router-link :to="{name: 'property_edit', params: { id: property.id }}" class="text-indigo-600 hover:text-indigo-900">Editar
                            </router-link>
                            <button class="text-indigo-600 hover:text-indigo-900" @click="deleteproperty(property.id)">Excluir</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                properties: []
            }
        },
        created() {
            this.axios
                .get('http://contratos.local/api/properties')
                .then(response => {
                    this.properties = response.data;
                });
        },
        methods: {
            deleteproperty(id) {
                this.axios
                    .delete(`http://contratos.local/api/property/delete/${id}`)
                    .then(response => {
                        let i = this.properties.map(item => item.id).indexOf(id); // find index of your object
                        this.properties.splice(i, 1)
                    });
            }
        }
    }
</script>