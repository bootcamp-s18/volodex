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

        <div v-for="vcard in vcardsData" class="card" v-bind="displayCardData(vcard)">
            <div class="card-header">
                <div class="float-left">
                    <h3>{{ name }}</h3>
                </div>
                <div class="float-right d-flex">
                    <div class="">
                        <button class="bg-transparent btn btn-sm"><a :href="'/vcards/' + vcard.id + '/edit'"><i class="fas fa-pencil-alt text-info"></i></a></button>
                    </div>
                    <div class="">
                        <form method="post" :action="'/vcards/' + vcard.id">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="bg-transparent btn btn-sm" type="submit"><i class="far fa-trash-alt text-danger"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul>  
                    <li v-if="item[1] != null" v-for="item in vcardAr">
                        {{ item[0] + ' ' + item[1] }}    
                    </li>   
                </ul>
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
            cData: null,
            vcardAr: null,
            name: null,

        }), 
        mounted() {
            console.log('made it');
            console.log(this.vcardsData);
            this.cData = this.vcardsData;

        },
        methods: {
            displayCardData: function (vcardData) {
                // console.log(vcardData);
                this.vcardAr = Object.entries(vcardData);
                this.vcardAr.splice(0, 2); //to remove the id of the user and vcard
                this.vcardAr.splice(this.vcardAr.length - 2, 2);

                if(vcardData.name_middle != null)
                {
                    this.name = vcardData.name_first + ' ' + vcardData.name_middle + ' ' + vcardData.name_last;
                }
                else
                {
                    this.name = vcardData.name_first + ' ' + vcardData.name_last;
                }
                
                this.vcardAr.splice(0,3); //to remove the first, middle, and last names         
            }

        }
    }
</script>