<template>
    <div>
        <h3 class="text-center">Add Property</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProperty">
                    <div class="form-group">
                        <label>E-mail do proprietário</label>
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
        methods: {
            addProperty() {

                this.axios
                    .post('http://contratos.local/api/property/store', this.property)
                    .then(response => (
                        this.$router.push({name: 'property'})
                        // console.log(response.data)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>