<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Editar Contrato</h3>
                <p class="mt-1 text-sm leading-5 text-gray-600">
                    Edição do contrato: {{ contract.uuid }}
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form @submit.prevent="updateContract" method="POST">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-8">
                                <label for="property_id" class="block text-sm font-medium leading-5 text-gray-700">Propriedade *</label>
                                <select id="property_id" required="required" v-model="contract.property_id" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option v-for="option in properties" v-bind:value="option.id" :key="option.id">
                                        {{ option.street }},  {{ option.number }}, {{ option.complement ? option.complement + ', ' : ''}} {{ option.neighborhood}}
                                    </option>
                                </select>
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.property_id" :key="index">{{ error }}</p>
                            </div>
                            <div class="col-span-8">
                                <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Nome completo *</label>
                                <input id="name" v-model="contract.name" required="required" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.name" :key="index">{{ error }}</p>
                            </div>
                            <div class="col-span-8">
                                <label for="email_contract" class="block text-sm font-medium leading-5 text-gray-700">E-mail *</label>
                                <input type="email" id="email_contract" v-model="contract.email_contract"  required="required" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.email_contract" :key="index">{{ error }}</p>
                            </div>

                            <div class="col-span-4">
                                <label for="type_person" class="block text-sm font-medium leading-5 text-gray-700">Tipo pessoa *</label>
                                <select id="status" v-model="contract.type_person"  required="required" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option value="F">Física</option>
                                <option value="J">Jurídica</option>
                                </select>
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.type_person" :key="index">{{ error }}</p>
                            </div>

                            <div class="col-span-4">
                                <label for="document" class="block text-sm font-medium leading-5 text-gray-700">{{ contract.type_person == 'F' ? 'CPF' : 'CNPJ' }} *</label>
                                <input id="document" v-model="document" required="required" v-mask="contract.type_person =='F' ? '###.###.###-##' : '##.###.###/####-##'" masked="true" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
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
                contract: {},
                properties: [],
                document: {},
                errors: [],
                isLoading: false
            }
        },
        async created() {
            var data = await this.axios
                .get(`http://contratos.local/api/contract/edit/${this.$route.params.id}`)
                .then(response => response.data)

            this.contract = data.contract
            this.document = data.contract.document
            this.properties = data.properties
        },
        methods: {
            voltar(){
                this.$router.push({name: 'contract'})
            },
            updateContract() {
                var withoutMask = this.document.replace(/[_\-./]/g,"")
                this.contract.document = withoutMask

                this.isLoading = true
                
                this.axios
                    .put(`http://contratos.local/api/contract/update/${this.$route.params.id}`, this.contract)
                    .then(function (response) {
                        if (response.errors){
                            this.errors = response.errors
                        }else{
                            Vue.swal('Sucesso!',response.data, 'success').then(function(){
                                location.href = '/contract'
                            })
                        }
                    })
                    .catch(error => {
                        if (error.response.data.errors){
                            this.errors = error.response.data.errors
                        }else{
                            Vue.swal('Ooops!', 'Não foi possível finalizar a operação, tente novamente.', 'error')
                        }
                    })
                    .finally(() => this.isLoading = false)
            }
        }
    }
</script>