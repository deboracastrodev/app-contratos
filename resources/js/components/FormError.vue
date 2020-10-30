<template>
    <div>
        <span class="label" style="color: red;">
            <div v-for="(error, index) in errors" :key="index">
                {{ error }}
            </div>
        </span>
    </div>
</template>

<script>
    export default {
        name: "form-error",
        props: {
            errors: {
                required: true,
                type: Array
            }
        }
    }
</script>