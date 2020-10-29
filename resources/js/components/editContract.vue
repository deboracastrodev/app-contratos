<template>
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Editar Contrato</h3>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form @submit.prevent="updatecontract">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control" v-model="contract.name">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>

</template>

<script>
    export default {
        data() {
            return {
                contract: {}
            }
        },
        created() {
            this.axios
                .get(`http://contratos.local/api/contract/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.contract = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
            updatecontract() {
                this.axios
                    .post(`http://contratos.local/api/contract/update/${this.$route.params.id}`, this.contract)
                    .then((response) => {
                        this.$router.push({name: 'contract'});
                    });
            }
        }
    }
</script>