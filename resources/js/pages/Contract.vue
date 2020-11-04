<template>

<div class="flex flex-col">
    <loading-overlay v-if="isLoading"></loading-overlay>

    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Gestão de Contratos
            </h1>
        </div>
        <div class="py-2 min-w-full text-right sm:px-6 lg:px-8">
            <button type="button" @click="add()" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline-blue active:bg-green-600 transition duration-150 ease-in-out">
                <i class="fa fa-plus"></i> Adicionar
            </button>
        </div>
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">

            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Contrato
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Contratante
                            </th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="contract in contracts" :key="contract.id">
                            <td class="px-6 py-4 whitespace-no-wrap">
                                {{ contract.property.street }},  {{ contract.property.number }}, {{ contract.property.neighborhood}}
                                <br>
                                <small>{{ contract.uuid }}</small>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                {{ contract.name }} - {{ contract.document | documentBr }}
                                <br><small>{{ contract.email_contract }}</small>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                <router-link  title="Editar" :to="{name: 'contract_edit', params: { id: contract.id }}" class="py-1 px-1 border border-transparent text-sm leading-3 font-medium rounded-md text-white bg-blue-600 shadow-sm hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">
                                    <i class="fa fa-edit"></i>
                                </router-link>
                                <button title="Excluir"  @click="deleteContract(contract.id)" class="py-1 px-1 border border-transparent text-sm leading-3 font-medium rounded-md text-white bg-red-600 shadow-sm hover:bg-red-500 focus:outline-none focus:shadow-outline-blue active:bg-red-600 transition duration-150 ease-in-out">
                                    <i class="fa fa-trash"></i>
                                </button>
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
                contracts: [],
                isLoading: false
            }
        },
        created() {
            this.getContracts()
        },
        methods: {
            add(){
                this.$router.push({name: 'contract_add'});
            },
            getContracts(){
                this.axios
                    .get('http://contratos.local/api/contracts')
                    .then(response => {
                        this.contracts = response.data;
                    });
            },
            async deleteContract(id) {
                this.isLoading = true;
                await this.axios
                    .delete(`http://contratos.local/api/contract/delete/${id}`)
                    .then(response => {
                        Vue.swal('Sucesso!', 'Registro excluído com sucesso!', 'success').then(function(){
                            location.href = '/contract'
                        })
                    })
                    .catch(error => {
                        Vue.swal('Ooops!', 'Não foi possível finalizar a operação, tente novamente.', 'error')
                        this.isLoading = false
                    })
                    .finally(() => this.isLoading = false)
            }
        }
    }
</script>