let contactsVue = new Vue({
    el:'#content',
    data:{
        contacts: [],
        contact: {},
        saving : false,
        spinner : '<i class="icon-spinner2 spinner"></i>',
        token: ''
    },
    methods:{
        init(){
            this.getContacts();
        },
        getContacts(){
            let vm = this;
            $.get('/ajax/contacts')
            .done(function( data ){
                if( data.success){
                    vm.contacts = data.contacts;
                }else{
                    toastr.error( data.message );
                }
            })
            .error(function( data ){
                toastr.error('Something went wrong');
            });
        },
        saveContact(){
            let vm = this;
            let i;
            vm.saving = true;
            $.post( '/ajax/contact' , $('#contactForm').serialize())
            .done(function( data ){
                if( data.success){
                    toastr.success( 'Contact successfully saved' );
                    $('#contactsModal').modal( 'toggle' );
                    for( i=0; i < vm.contacts.length; i++ ){
                        d = vm.contacts[i];
                        if(d.id == data.contact.id ){
                            Vue.set( vm.contacts, i , data.contact );
                            vm.saving = false;
                            return;
                        }
                    }

                    vm.contacts.push( data.contact );
                }else{
                    toastr.error( data.message );
                    vm.saving = false;
                }
                vm.saving = false;
            })
            .error(function( data ){
                toastr.error('Something went wrong');
                vm.saving = false;
            });
        },
        addContact(){
            this.contact = {};
            $('#contactsModal').modal()
        },
        editContact( contact_id ){
            this.contact = $.grep( this.contacts, function( c){
                return c.id == contact_id
            })[0];
            $('#contactsModal').modal()
        },
        deleteContact( contact_id ){
            let vm = this;
            let i;
            $.ajax({ url: '/ajax/contact', type: 'DELETE',dataType:'json',
                data:{ contact_id : contact_id , _token: vm.token },
                success: function( data ) {
                    if( data.success ){
                        for( i=0; i < vm.contacts.length; i++ ){
                            d = vm.contacts[i];
                            if(d.id == data.contact_id ){
                                toastr.success( 'Contact successfully deleted' );
                                vm.contacts.splice( i , 1 );
                                return;
                            }
                        }
                    }

                }
            }).fail(function() {

            })
        }
    },
    mounted:function(){
        this.init();
        this.token = $('input[name=_token]').val();
    }
});


