<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset( $title ) ? $title : '' ?></title>

    <!-- Global stylesheets -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" type="text/css">

    <!--<link href="/css/fa/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <!-- /global stylesheets -->

    <style>
        [v-cloak] { display:none; },
    </style>
</head>
<body>
    <div id="content" class="v-cloak">
        <div class="row">
            <div class="col-lg-4">
                <div>
                    <h2>Contacts <a href="javascript:" @click="addContact" class="btn btn-default"> <i class="icon-plus2"></i> </a></h2>
                </div>
                <div class="row">
                    <table class="table table-striped">
                        <tr v-for="contact in contacts">
                            <td>
                                <div class="pull-right">
                                    <ul class="icons-list" style="list-style: none">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="javascript:" @click="editContact(contact.id)"><i class="icon-pencil"></i> Edit </a></li>
                                                <li><a href="javascript:" @click="deleteContact(contact.id)"><i class="icon-cross2 text-danger"></i> Delete </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <b>{{contact.name}}</b>
                            </td>
                        </tr>
                        <tr v-show="!saving && !contacts.length ">
                            <td> No contact found</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="contactsModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">{{contact.id ? 'Edit' : 'Add'  }} Contact </h4>
                    </div>
                    <form id="contactForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" v-model="contact.name" id="name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" v-model="contact.email" id="email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" v-model="contact.phone" id="phone" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" v-model="contact.city" id="city" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" name="state" v-model="contact.state" id="state" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" name="country" v-model="contact.country" id="country" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" name="postal_code" v-model="contact.postal_code" id="postal_code" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="saveContact" v-html=" saving ? spinner : 'Save' " :disabled="saving"></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                        <input type="hidden" name="id" id="id" v-model="contact.id" />
                        <?php echo csrf_field() ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/vue.js"></script>
<script type="text/javascript" src="/js/contacts.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</html>