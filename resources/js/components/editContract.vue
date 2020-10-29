<template>
    <div>
        <h3 class="text-center">Editar Contrato</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updatecontract">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control" v-model="contract.name">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
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