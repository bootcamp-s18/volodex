<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <a>+ Add new contact</a>
            </div>
            <div class="form-group card-body">
                <label for="searchBox" class="font-weight-bold">Filter Contacts:</label>
                <input id="searchBox" class="form-control" type="text" v-model="searchString" placeholder="Enter your search terms" />
            </div>
        </div>

        <div v-for="contact in filteredContacts" class="card">
            <div class="card-header">

            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            
        }
    }
</script>