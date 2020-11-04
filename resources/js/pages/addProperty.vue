<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <loading-overlay v-if="isLoading"></loading-overlay>

        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Adicionar Propriedade</h3>
                <p class="mt-1 text-sm leading-5 text-gray-600">
                    Cadastre uma propriedade.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form @submit.prevent="addProperty" method="POST">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-8">
                                <label for="email_property" class="block text-sm font-medium leading-5 text-gray-700">E-mail do proprietário *</label>
                                <input id="email_property" type="email" required="required" v-model="property.email_property" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.email_property" :key="index">{{ error }}</p>                        
                            </div>

                            <div class="col-span-6">
                                <label for="street" class="block text-sm font-medium leading-5 text-gray-700">Rua *</label>
                                <input id="street" required="required"  v-model="property.street" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.street" :key="index">{{ error }}</p>                        
                            </div>

                            <div class="col-span-2">
                                <label for="number" class="block text-sm font-medium leading-5 text-gray-700">Nº</label>
                                <input id="number" v-model="property.number" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.number" :key="index">{{ error }}</p>                        
                            </div>

                            <div class="col-span-4">
                                <label for="complement" class="block text-sm font-medium leading-5 text-gray-700">Complemento</label>
                                <input id="complement" v-model="property.complement" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.complement" :key="index">{{ error }}</p>                        
                            </div>

                            <div class="col-span-4">
                                <label for="neighborhood" class="block text-sm font-medium leading-5 text-gray-700">Bairro *</label>
                                <input id="neighborhood" required="required"  v-model="property.neighborhood" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.neighborhood" :key="index">{{ error }}</p>                        
                            </div>

                            <div class="col-span-4">
                                <label for="city" class="block text-sm font-medium leading-5 text-gray-700">Cidade *</label>
                                <input id="city" required="required" v-model="property.city" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.city" :key="index">{{ error }}</p>                        
                            </div>

                            <div class="col-span-4">
                                <label for="state" class="block text-sm font-medium leading-5 text-gray-700">Estado* </label>
                                <input id="state" required="required" v-model="property.state" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <p class="text-red-500 text-xs italic" v-for="(error, index) in errors.state" :key="index">{{ error }}</p>                        
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
                property: {
                    status: 'N'
                },
                errors: [],
                isLoading: false
            }
        },
        methods: {
            voltar(){
                this.$router.push({name: 'property'})
            },
            addProperty() {
                this.isLoading = true
                this.axios
                    .post('http://contratos.local/api/property/store', this.property)
                    .then(function (response) {
                        Vue.swal('Sucesso!',response.data, 'success').then(
                            location.href = '/property'
                        )
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