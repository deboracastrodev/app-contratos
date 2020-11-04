<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <loading-overlay v-if="isLoading"></loading-overlay>

        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Adicionar Contrato</h3>
                <p class="mt-1 text-sm leading-5 text-gray-600">
                    Cadastre um contrato referente a uma propriedade.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form @submit.prevent="addContract" method="POST">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-8">
                                <label for="property_id" class="block text-sm font-medium leading-5 text-gray-700">
                                    Propriedade * 
                                    <router-link  title="Adicionar propriedade" :to="{name: 'property_add'}" class="text-sm font-medium rounded-md text-green-500 hover:text-blue-500 focus:outline-none focus:shadow-outline-blue active:text-blue-600 transition duration-150 ease-in-out">
                                        <i class="fa fa-plus"></i>
                                    </router-link>
                                </label>
                                <select id="property_id" required="required" v-model="contract.property_id" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option v-for="option in properties" v-bind:key="option.id" v-bind:value="option.id">
                                        {{ option.street }},  {{ option.number }}, {{ option.complement ? option.complement + ', ' : ''}} {{ option.neighborhood}}
                                    </option>
                                </select>
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.option_id" :key="index">{{ error }}</p>
                            </div>

                            <div class="col-span-8">
                                <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Nome completo * </label>
                                <input id="name" required="required" v-model="contract.name" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.name" :key="index">{{ error }}</p>
                            </div>

                            <div class="col-span-8">
                                <label for="email_contract" class="block text-sm font-medium leading-5 text-gray-700">E-mail * </label>
                                <input type="email" v-model="contract.email_contract" required="required" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.email_contract" :key="index">{{ error }}</p>
                            </div>

                            <div class="col-span-4">
                                <label for="type_person" class="block text-sm font-medium leading-5 text-gray-700">Tipo pessoa * </label>
                                <select id="type_person" required="required" v-model="contract.type_person" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option value="F">Física</option>
                                    <option value="J">Jurídica</option>
                                </select>
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.type_person" :key="index">{{ error }}</p>
                            </div>

                            <div class="col-span-4">
                                <label for="document" class="block text-sm font-medium leading-5 text-gray-700">{{ contract.type_person == 'F' ? 'CPF' : 'CNPJ' }} * </label>
                                <input id="document" required="required" v-model="document" v-mask="contract.type_person =='F' ? '###.###.###-##' : '##.###.###/####-##'" masked="true" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.document" :key="index">{{ error }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="button" @click="voltar()" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 shadow-sm hover:bg-red-500 focus:outline-none focus:shadow-outline-blue active:bg-red-600 transition duration-150 ease-in-out">
                            <i class="fa fa-times"></i> Cancelar
                        </button>
                        <button type="submit" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                            <i class="fa fa-check"></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                contract: {
                    type_person: 'F',
                    document: ''
                },
                document: '',
                properties: [],
                errors: [],
                isLoading: false
            }
        },
        created() {
            this.axios
                .get('http://contratos.local/api/properties-status')
                .then(response => {
                    this.properties = response.data;
                });
        },
        methods: {
            voltar(){
                this.$router.push({name: 'contract'})
            },
            addContract() {
                var withoutMask = this.document.replace(/[_\-./]/g,"")
                this.contract.document = withoutMask

                this.isLoading = true
                this.axios
                    .post('http://contratos.local/api/contract/store', this.contract)
                    .then(function (response) {
                        Vue.swal('Sucesso!',response.data, 'success').then(function(){
                            location.href = '/contract'
                        })
                    })
                    .catch(error => {
                        if (error.response.data.errors){
                            this.errors = error.response.data.errors;
                        }else{
                            Vue.swal('Ooops!', 'Não foi possível finalizar a operação, tente novamente.', 'error');
                        }
                    })
                    .finally(() => this.isLoading = false)
            }
        }
    }
</script>