<template>

    <div class="layout-wrapper d-lg-flex">

        <!-- Start left sidebar-menu -->
        <div class="side-menu flex-lg-column me-lg-1 ms-lg-0">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- <a :href="url('/admin')" class="logo logo-dark" title="الصفحة الرئيسية">
                    <span class="logo-sm">
                        <img :src="asset('assets/img/logo.ico')" alt="" height="50px">
                    </span>
                </a> -->
            </div>
            <!-- end navbar-brand-box -->

            <!-- Start side-menu nav -->
            <div class="flex-lg-column my-auto">
                <ul class="nav nav-pills side-menu-nav justify-content-center" role="tablist">
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Profile">
                        <a class="nav-link" id="pills-user-tab" data-bs-toggle="pill" href="#pills-user" role="tab">
                            <i class="ri-user-2-line"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="الرسائل">
                        <a class="nav-link active" id="pills-chat-tab" data-bs-toggle="pill" href="#pills-chat" role="tab">
                            <i class="ri-message-3-line"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="المجموعات">
                        <a class="nav-link" id="pills-groups-tab" data-bs-toggle="pill" href="#pills-groups" role="tab">
                            <i class="ri-group-line"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="الأفراد">
                        <a class="nav-link" id="pills-contacts-tab" data-bs-toggle="pill" href="#pills-contacts" role="tab">
                            <i class="ri-contacts-line"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Settings">
                        <a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#pills-setting" role="tab">
                            <i class="ri-settings-2-line"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- end side-menu nav -->

            <div class="flex-lg-column d-none d-lg-block">
                <ul class="nav side-menu-nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" id="light-dark" href="#" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="" data-bs-original-title="Dark / Light Mode">
                            <i class="ri-sun-line theme-mode-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a @click="logout" class="nav-link" id="light-dark" href="#" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="" data-bs-original-title="Dark / Light Mode">
                            <i class="ri-logout-circle-r-line"></i>
                        </a>
                    </li>

                    <!-- <li class="nav-item btn-group profile-user-dropdown" style="cursor: pointer"> -->
                        <!-- <img v-if="authUser.avatar != ''" :src="asset(authUser.avatar)" alt="" class="profile-user rounded-circle"> -->
                        <!--<img v-else :src="asset('messenger/images/0.jpeg')" alt="" class="profile-user rounded-circle imgavatar">-->
                        <!-- <div v-else class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                {{ firstCharacterOfName }}
                            </span>
                        </div> -->
                    <!-- </li> -->
                </ul>
            </div>
            <!-- Side menu user -->
        </div>
        <!-- end left sidebar-menu -->

        <!-- start chat-leftsidebar -->
        <div class="chat-leftsidebar me-lg-1 ms-lg-0">

            <div class="tab-content">

                <!-- Start Profile tab-pane -->
                <div class="tab-pane" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
                    <!-- Start profile content -->
                    <div>
                        <div class="px-4 pt-4">
                            <div class="user-chat-nav float-end">
                                <div class="dropdown">
                                    <a href="#" class="font-size-18 text-muted dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Edit</a>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mb-0">My Profile</h4>
                        </div>

                        <div class="text-center p-4 border-bottom">
                            <div class="mb-4">
                                <img :src="asset('messenger2/avatar-1.jpg')" class="rounded-circle avatar-lg img-thumbnail" alt="">
                            </div>

                            <h5 class="font-size-16 mb-1 text-truncate">{{ authUser.name }}</h5>
                            <p class="text-muted text-truncate mb-1"><i class="ri-record-circle-fill font-size-10 text-success me-1 ms-0 d-inline-block"></i> Active</p>
                        </div>
                        <!-- End profile user -->

                        <!-- Start user-profile-desc -->
                        <div class="p-4 user-profile-desc" data-simplebar="init"><div class="simplebar-wrapper" style="margin: -24px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="left: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 24px;">
                            <div class="text-muted">
                                <p class="mb-4">If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual.</p>
                            </div>


                            <div id="tabprofile" class="accordion">
                                <div class="accordion-item card border mb-2">
                                    <div class="accordion-header" id="about2">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#about" aria-expanded="true" aria-controls="about">
                                            <h5 class="font-size-14 m-0">
                                                <i class="ri-user-2-line me-2 ms-0 ms-0 align-middle d-inline-block"></i> About
                                            </h5>
                                        </button>
                                    </div>
                                    <div id="about" class="accordion-collapse collapse show" aria-labelledby="about2" data-bs-parent="#tabprofile">
                                        <div class="accordion-body">
                                            <div>
                                                <p class="text-muted mb-1">Name</p>
                                                <h5 class="font-size-14">{{ authUser.name }}</h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Email</p>
                                                <h5 class="font-size-14">{{ authUser.email }}</h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Time</p>
                                                <h5 class="font-size-14">11:40 AM</h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Location</p>
                                                <h5 class="font-size-14 mb-0">California, USA</h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">ID</p>
                                                <h5 class="font-size-14">{{ authUser.hash }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End About card -->

                                <div class="card accordion-item border">
                                    <div class="accordion-header" id="attachfile2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#attachfile" aria-expanded="false" aria-controls="attachfile">
                                            <h5 class="font-size-14 m-0">
                                                <i class="ri-attachment-line me-2 ms-0 ms-0 align-middle d-inline-block"></i> Attached Files
                                            </h5>
                                        </button>
                                    </div>
                                    <div id="attachfile" class="accordion-collapse collapse" aria-labelledby="attachfile2" data-bs-parent="#tabprofile">
                                        <div class="accordion-body">
                                            <div class="card p-2 border mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-3 ms-0">
                                                        <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                                            <i class="ri-file-text-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="text-start">
                                                            <h5 class="font-size-14 mb-1">Admin-A.zip</h5>
                                                            <p class="text-muted font-size-13 mb-0">12.5 MB</p>
                                                        </div>
                                                    </div>

                                                    <div class="ms-4 me-0">
                                                        <ul class="list-inline mb-0 font-size-18">
                                                            <li class="list-inline-item">
                                                                <a href="#" class="text-muted px-1">
                                                                    <i class="ri-download-2-line"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item dropdown">
                                                                <a class="dropdown-toggle text-muted px-1" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ri-more-fill"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Action</a>
                                                                    <a class="dropdown-item" href="#">Another action</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card p-2 border mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-3 ms-0">
                                                        <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                                            <i class="ri-image-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="text-start">
                                                            <h5 class="font-size-14 mb-1">Image-1.jpg</h5>
                                                            <p class="text-muted font-size-13 mb-0">4.2 MB</p>
                                                        </div>
                                                    </div>

                                                    <div class="ms-4 me-0">
                                                        <ul class="list-inline mb-0 font-size-18">
                                                            <li class="list-inline-item">
                                                                <a href="#" class="text-muted px-1">
                                                                    <i class="ri-download-2-line"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item dropdown">
                                                                <a class="dropdown-toggle text-muted px-1" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ri-more-fill"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Action</a>
                                                                    <a class="dropdown-item" href="#">Another action</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card p-2 border mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-3 ms-0">
                                                        <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                                            <i class="ri-image-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="text-start">
                                                            <h5 class="font-size-14 mb-1">Image-2.jpg</h5>
                                                            <p class="text-muted font-size-13 mb-0">3.1 MB</p>
                                                        </div>
                                                    </div>

                                                    <div class="ms-4 me-0">
                                                        <ul class="list-inline mb-0 font-size-18">
                                                            <li class="list-inline-item">
                                                                <a href="#" class="text-muted px-1">
                                                                    <i class="ri-download-2-line"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item dropdown">
                                                                <a class="dropdown-toggle text-muted px-1" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ri-more-fill"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Action</a>
                                                                    <a class="dropdown-item" href="#">Another action</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card p-2 border mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-3 ms-0">
                                                        <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                                            <i class="ri-file-text-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="text-start">
                                                            <h5 class="font-size-14 mb-1">Landing-A.zip</h5>
                                                            <p class="text-muted font-size-13 mb-0">6.7 MB</p>
                                                        </div>
                                                    </div>

                                                    <div class="ms-4 me-0">
                                                        <ul class="list-inline mb-0 font-size-18">
                                                            <li class="list-inline-item">
                                                                <a href="#" class="text-muted px-1">
                                                                    <i class="ri-download-2-line"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item dropdown">
                                                                <a class="dropdown-toggle text-muted px-1" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ri-more-fill"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Action</a>
                                                                    <a class="dropdown-item" href="#">Another action</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Attached Files card -->
                            </div>
                            <!-- end profile-user-accordion -->

                        </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div></div>
                        <!-- end user-profile-desc -->
                    </div>
                    <!-- End profile content -->
                </div>
                <!-- End Profile tab-pane -->


                <!-- Start chats tab-pane -->
                <div class="tab-pane fade show active" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
                    <!-- Start chats content -->
                    <div>
                        <div class="px-4 pt-4">
                            <h4 class="mb-4">الرسائل</h4>
                            <div class="search-box chat-search-box">
                                <div class="input-group mb-3 rounded-3">
                                    <span class="input-group-text text-muted bg-light pe-1 ps-3" id="basic-addon1">
                                        <i class="ri-search-line search-icon font-size-18"></i>
                                    </span>
                                    <input v-model="searchTerm" @input="filterThreads" type="text" class="form-control bg-light" placeholder="إبحث بإسم المستخدم" aria-label="Search messages or users" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>

                        <div class="px-4 pb-4" dir="ltr">

                            <carousel v-if="activeThreads.length > 0" :key="refresh" :items="4" :margin="16" :loop="!1" :nav="!1" :dots="!1" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;" >

                                <thread-active v-for="activeThread in activeThreads" :key="activeThread.id" :thread="activeThread"></thread-active>

                            </carousel>

                        </div>

                        <thread-section
                            :type="'users'"
                        ></thread-section>

                    </div>
                </div>
                <!-- End chats tab-pane -->

                <!-- Start groups tab-pane -->
                <div class="tab-pane" id="pills-groups" role="tabpanel" aria-labelledby="pills-groups-tab">
                    <!-- Start Groups content -->
                    <group-section></group-section>
                    <!-- End Groups content -->
                </div>
                <!-- End groups tab-pane -->

                <!-- Start contacts tab-pane -->
                <div class="tab-pane" id="pills-contacts" role="tabpanel" aria-labelledby="pills-contacts-tab">
                    <!-- Start Contact content -->
                    <contact-section></contact-section>
                    <!-- Start Contact content -->
                </div>
                <!-- End contacts tab-pane -->

                <!-- Start add contact Modal -->
                <div id="addContact" ref="addContactModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addcontact-exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-size-16" id="addcontact-exampleModalLabel">إرسال رسالة إلى {{ contactModalData.name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="mb-4">
                                    <img v-if="contactModalData.avatar && contactModalData.avatar != ''" :src="asset(contactModalData.avatar)" class="rounded-circle avatar-lg img-thumbnail" alt="">
                                    <div v-else class="avatar-first-character avatar-title rounded-circle avatar-lg img-thumbnail bg-soft-primary text-primary" style="font-size:35px">
                                        <template v-if="contactModalData.name">{{ contactModalData.name.substring(0, 1).toUpperCase() }}</template>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h5 class="font-size-16">الإسم: </h5>
                                        <h5 class="font-size-16">البريد الإلكترونى: </h5>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="font-size-14">{{ contactModalData.name }}</h5>
                                        <h5 class="font-size-14">{{ contactModalData.email }}</h5>
                                    </div>
                                </div> 
                                <form>
                                    <div class="mb-3">
                                        <label for="addgroupdescription-input" class="form-label">الرسالة:</label>
                                        <textarea v-model="contactModalData.message" class="form-control" id="addgroupdescription-input" rows="3" placeholder="إكتب رسالتك"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-bs-dismiss="modal">إغلاق</button>
                                <button @click="sendContactMessage" type="button" class="btn btn-primary">إضافة</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End add contact Modal -->


                <!-- Start settings tab-pane -->
                <div class="tab-pane" id="pills-setting" role="tabpanel" aria-labelledby="pills-setting-tab">
                    <!-- Start Settings content -->
                    <div>
                        <div class="px-4 pt-4">
                            <h4 class="mb-0">Settings</h4>
                        </div>

                        <div class="text-center border-bottom p-4">
                            <div class="mb-4 profile-user">
                                <img :src="asset('messenger2/avatar-1.jpg')" class="rounded-circle avatar-lg img-thumbnail" alt="">
                                <button type="button" class="btn btn-light bg-light avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <i class="ri-pencil-fill"></i>
                                </button>
                            </div>

                            <h5 class="font-size-16 mb-1 text-truncate">Patricia Smith</h5>
                            <div class="dropdown d-inline-block mb-1">
                                <a class="text-muted dropdown-toggle pb-1 d-block" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Available <i class="mdi mdi-chevron-down"></i>
                                </a>
        
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Available</a>
                                    <a class="dropdown-item" href="#">Busy</a>
                                </div>
                            </div>
                        </div>
                        <!-- End profile user -->

                        <!-- Start User profile description -->
                        <div class="p-4 user-profile-desc" data-simplebar="init"><div class="simplebar-wrapper" style="margin: -24px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="left: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 24px;">        
                            <div id="settingprofile" class="accordion">
                                <div class="accordion-item card border mb-2">
                                    <div class="accordion-header" id="personalinfo1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#personalinfo" aria-expanded="true" aria-controls="personalinfo">
                                            <h5 class="font-size-14 m-0">Personal Info</h5>
                                        </button>
                                    </div>
                                    <div id="personalinfo" class="accordion-collapse collapse show" aria-labelledby="personalinfo1" data-bs-parent="#settingprofile">
                                        <div class="accordion-body">
                                            <div class="float-end">
                                                <button type="button" class="btn btn-light btn-sm"><i class="ri-edit-fill me-1 ms-0 align-middle"></i> Edit</button>
                                            </div>

                                            <div>
                                                <p class="text-muted mb-1">Name</p>
                                                <h5 class="font-size-14">Patricia Smith</h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Email</p>
                                                <h5 class="font-size-14">adc@123.com</h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Time</p>
                                                <h5 class="font-size-14">11:40 AM</h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Location</p>
                                                <h5 class="font-size-14 mb-0">California, USA</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end personal info card -->

                                <div class="accordion-item card border mb-2">
                                    <div class="accordion-header" id="privacy1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#privacy" aria-expanded="false" aria-controls="privacy">
                                            <h5 class="font-size-14 m-0">Privacy</h5>
                                        </button>
                                    </div>
                                    <div id="privacy" class="accordion-collapse collapse" aria-labelledby="privacy1" data-bs-parent="#settingprofile">
                                        <div class="accordion-body">
                                            <div class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-13 mb-0 text-truncate">Profile photo</h5>
                                                    </div>
                                                    <div class="dropdown ms-2 me-0">
                                                        <button class="btn btn-light btn-sm dropdown-toggle w-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Everyone <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Everyone</a>
                                                            <a class="dropdown-item" href="#">selected</a>
                                                            <a class="dropdown-item" href="#">Nobody</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="py-3 border-top">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-13 mb-0 text-truncate">Last seen</h5>

                                                    </div>
                                                    <div class="ms-2 me-0">
                                                        <div class="form-check form-switch">
                                                            <input type="checkbox" class="form-check-input" id="privacy-lastseenSwitch" checked="">
                                                            <label class="form-check-label" for="privacy-lastseenSwitch"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="py-3 border-top">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-13 mb-0 text-truncate">Status</h5>
                                                    </div>
                                                    <div class="dropdown ms-2 me-0">
                                                        <button class="btn btn-light btn-sm dropdown-toggle w-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Everyone <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Everyone</a>
                                                            <a class="dropdown-item" href="#">selected</a>
                                                            <a class="dropdown-item" href="#">Nobody</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="py-3 border-top">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-13 mb-0 text-truncate">Read receipts</h5>
                                                    </div>
                                                    <div class="ms-2 me-0">
                                                        <div class="form-check form-switch">
                                                            <input type="checkbox" class="form-check-input" id="privacy-readreceiptSwitch" checked="">
                                                            <label class="form-check-label" for="privacy-readreceiptSwitch"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="py-3 border-top">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-13 mb-0 text-truncate">Groups</h5>

                                                    </div>
                                                    <div class="dropdown ms-2 me-0">
                                                        <button class="btn btn-light btn-sm dropdown-toggle w-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Everyone <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Everyone</a>
                                                            <a class="dropdown-item" href="#">selected</a>
                                                            <a class="dropdown-item" href="#">Nobody</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end privacy card -->

                                <div class="accordion-item card border mb-2">
                                    <div class="accordion-header" id="security1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#security" aria-expanded="false" aria-controls="security">
                                            <h5 class="font-size-14 m-0"> Security</h5>
                                        </button>
                                    </div>
                                    <div id="security" class="accordion-collapse collapse" aria-labelledby="security1" data-bs-parent="#settingprofile">
                                        <div class="accordion-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-1 overflow-hidden">
                                                    <h5 class="font-size-13 mb-0 text-truncate">Show security notification</h5>

                                                </div>
                                                <div class="ms-2 me-0">
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input" id="security-notificationswitch">
                                                        <label class="form-check-label" for="security-notificationswitch"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end security card -->

                                <div class="accordion-item card border mb-2">
                                    <div class="accordion-header" id="help1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            <h5 class="font-size-14 m-0"> Help</h5>
                                        </button>
                                    </div>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="help1" data-bs-parent="#settingprofile">
                                        <div class="accordion-body">
                                            <div class="py-3">
                                                <h5 class="font-size-13 mb-0"><a href="#" class="text-body d-block">FAQs</a></h5>
                                            </div>
                                            <div class="py-3 border-top">
                                                <h5 class="font-size-13 mb-0"><a href="#" class="text-body d-block">Contact</a></h5>
                                            </div>
                                            <div class="py-3 border-top">
                                                <h5 class="font-size-13 mb-0"><a href="#" class="text-body d-block">Terms &amp; Privacy policy</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end profile-setting-accordion -->
                        </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div></div>
                        <!-- End User profile description -->
                    </div>
                    <!-- Start Settings content -->
                </div>
                <!-- End settings tab-pane -->

            </div>
            <!-- end tab content -->

        </div>
        <!-- end chat-leftsidebar -->

        <!-- Start User chat -->
        <chat-section></chat-section>
        <!-- end  layout wrapper -->
    </div>

</template>

<script>

    import ThreadSection from './ThreadSection.vue'
    import ContactSection from './ContactSection.vue'
    import GroupSection from './GroupSection.vue'
    import ChatSection from './ChatSection.vue'
    import ThreadActive from './ThreadActive.vue'
    import carousel from 'vue-owl-carousel'
    import { mapGetters, mapActions } from 'vuex'

    export default {
        data: function (){
          return {
              searchTerm: '',
              refresh: 0,
              createdMessageInfo: {
                thread: '',
                message: '',
              },
              contactModalData: {}
          }
        },
        sockets: {
            join: function (user) {
                this.addActiveThread(user)
            },
            leave: function (user) {
                this.removeActiveThread(user)
            },
        },
        methods: {
            axiosURL(url){
                axios.defaults.headers.common['X-CSRF-TOKEN'] = document.getElementsByName('csrf-token')[0].getAttribute('content')
                return (window._backpack_url || '') + '/' + url
            },
            logout(){
                axios.post(this.axiosURL('logout')).then(response => { 
                    // console.log(response);
                    window.location.href = "/login";
                })
                .catch(error => {
                    console.log(error);
                })
            },
            loginChat(){
                this.$socket.emit('join', {user: this.authUser, threads: this.subscribedThreads})
            },
            async createUserThreadIfNot(users){
                await axios.post(this.axiosURL('api/createUserThread'), {users: users})
                    .then(response => (
                        this.createdMessageInfo.thread = response.data,
                        console.log(this.createdMessageInfo)
                    ))
            },
            async saveMessageToDB(text, thread){
                await axios.post(this.axiosURL('api/createMessage'), { text: text, thread: thread, attachments: {}, record: {} })
                    .then(response => (
                    this.createdMessageInfo.message = response.data,
                    console.log(this.createdMessageInfo)

                ))
            },
            ...mapActions({
                async sendContactMessage (dispatch) {
                    const { contactModalData, authUser, createdMessageInfo } = this
                    if (contactModalData.message.trim()) {
                        await this.createUserThreadIfNot([authUser.id, contactModalData.id])
                        const thread = { id: this.createdMessageInfo.thread, type: 'user', users: [authUser, contactModalData] }
                        await this.saveMessageToDB(contactModalData.message.trim(), thread)

                        const messageBody = {
                            id: this.createdMessageInfo.message.id,
                            text: contactModalData.message,
                            timestamp: Date.parse(this.createdMessageInfo.message.timestamp),
                            attachments: {},
                            record: {},
                            author: authUser,
                            thread: thread,
                            contact: contactModalData
                        }

                        dispatch('sendContactMessage', messageBody)
                        this.$socket.emit('subscribe', {message: messageBody, thread: this.createdMessageInfo.thread, contact: contactModalData.id})
                        this.contactMessage = ''
                        $(this.$refs.addContactModal).modal('hide')
                    }
                },
                recieveContactMessage (dispatch, data) {
                    dispatch('sendContactMessage', {
                        id: data.id,
                        text: data.text,
                        timestamp: data.timestamp,
                        attachments: {},
                        record: {},
                        author: data.author,
                        thread: data.thread,
                        contact: data.contact
                    })
                },
                filterThreads(dispatch){
                    const {searchTerm} = this
                    dispatch('filterThreads', {
                        searchTerm,
                        par: 'user'
                    })
                },
                addActiveThread (dispatch, user) {
                    dispatch('addActiveThread', {
                        user
                    })
                },
                removeActiveThread (dispatch, user) {
                    dispatch('removeActiveThread', {
                        user
                    })
                }
            }),
        },
        watch: {
            'activeThreads': function () {
                this.refresh++
            },
        },
        computed: {
            authUser(){
                return this.$store.state.authUser
            },
            subscribedThreads(){
                return this.$store.state.subscribedThreads
            },
            firstCharacterOfName: function(){
                return this.authUser.name[0].toUpperCase()
            },
            ...mapGetters(['activeThreads'])
        },
        components: {
            'thread-section': ThreadSection,
            'contact-section': ContactSection,
            'group-section': GroupSection,
            'chat-section': ChatSection,
            'thread-active': ThreadActive,
            'carousel': carousel,
        },
        mounted(){
            console.log('ChatApp Component mounted.')
            var url = window.location.href
            var idx = url.indexOf('?u=') 
            if(idx != -1) {
                var hash = url.split('?u=')[1]
                axios.get(this.axiosURL('api/userHash') + '/' + hash).then(({ data }) => {

                    this.contactModalData = {
                        name: new String(data.name),
                        hash: data.hash,
                        email: data.email,
                        avatar: data.avatar,
                        id: data.id,
                        message: ''
                    }
                    $(this.$refs.addContactModal).modal('show')

                })
            }
            this.loginChat()
        }
    }
</script>

<style lang="scss">

</style>
