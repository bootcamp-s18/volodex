<template>
    <div class="container">
        <div class="card m-3">
            <div class="card-header">
                <a href="/vcards/create">+ Add new contact</a>
            </div>
            <div class="form-group card-body">
                <label for="searchBox" class="font-weight-bold">Filter Contacts By First or Last Name:</label>
                <input id="searchBox" class="form-control" type="text" v-model="searchString" placeholder="Enter first or last name" />
            </div>
        </div>
        <div v-for="vcard in filteredVcards" class="card m-3" v-bind="displayCardData(vcard)">
            <div class="card-header">
                <div class="float-left">
                    <h3>{{ name }}</h3>
                </div>
                <div class="float-right d-flex">
                    <div>
                        <a class="btn btn-sm bg-transparent"><i class="text-primary fas fa-download"></i></a>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm bg-transparent" data-toggle="modal" data-target="#shareModal">
                            <i class="fas fa-share-square text-success"></i>
                        </button>
                        <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="shareModalLabel">Enter Email</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" :action="'/vcards/share/' + vcard.id">
                                        <div class="modal-body">
                                            
                                            <div class="form-group">
                                                <label for="share_email"></label>
                                                <input type="email" class="form-control" name="share_email" id="share_email">
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="_token" :value="csrf">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <strong> {{ makeStringLookPretty(item[0]) }}</strong> {{ item[1] }}    
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
            vcardAr: null,
            name: null,

        }), 
        mounted() {
            console.log('made it');
            console.log(this.vcardsData);
        },
        computed: {
            filteredVcards: function() {
                var vcards_array = this.vcardsData;
                console.log(this.searchString.toLowerCase());
                var search_string = this.searchString.toLowerCase();
                if (!search_string) {
                    return vcards_array;
                }
                vcards_array = vcards_array.filter(function(item) {
                    if(item.name_first.toLowerCase().indexOf(search_string) !== -1 || item.name_last.toLowerCase().indexOf(search_string) !== -1) {
                        return item;
                    }
                });
                return vcards_array;
            }
        },
        methods: {
            makeStringLookPretty: function (word) {
                word = word.replace('_', ' ');
                word = word.split(" ");
                for(var i = 0; i < word.length; i++)
                {
                    word[i] = word[i][0].toUpperCase() + word[i].substring(1);
                }
                return word.join(' ') + ': ';

            },
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