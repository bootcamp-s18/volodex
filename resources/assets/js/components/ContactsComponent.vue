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

        <div v-for="vcard in vcardsData" class="card">
            <div class="card-header">
                <h3>{{ vcard.name_first }}</h3>
            </div>
            <div class="card-body">
                {{ vcard.email_personal }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['vcardsData'],
        data: () => ({
            searchString: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            cData: null
        }), 
        mounted() {
            console.log('made it');
            console.log(this.vcardsData);
            this.cData = this.vcardsData;

        },
        methods: {
            
        }
    }
</script>