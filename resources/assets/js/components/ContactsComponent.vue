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

        <div v-for="contact in cData" class="card">
            <div class="card-header">
                {{ contact.vcardInfo.name_first }}
            </div>
            <div class="card-body">
                {{ contact.vcardInfo.email_personal }}                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['contactsData'],
        data: () => ({
            searchString: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            cData: null
        }), 
        mounted() {
            console.log('made it');
            console.log(this.contactsData);
            this.cData = this.contactsData;

        },
        methods: {
            
        }
    }
</script>