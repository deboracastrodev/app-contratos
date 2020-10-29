<template>
    <div>
        <h3 class="text-center">Editar Propriedade</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateProperty">
                    <div class="form-group">
                        <label>E-mail do proprietário:</label>
                        <input type="text" class="form-control" v-model="property.email_property">
                    </div>
                    <h1>Endereço da propriedade</h1>
                    <div class="form-group">
                        <label>Rua</label>
                        <input type="text" class="form-control" v-model="property.street">
                    </div>
                    <div class="form-group">
                        <label>Número</label>
                        <input type="text" class="form-control" v-model="property.number">
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
                property: {}
            }
        },
        created() {
            this.axios
                .get(`http://contratos.local/api/property/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.property = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
            updateProperty() {
                this.axios
                    .post(`http://contratos.local/api/property/update/${this.$route.params.id}`, this.property)
                    .then((response) => {
                        this.$router.push({name: 'property'});
                    });
            }
        }
    }
</script>