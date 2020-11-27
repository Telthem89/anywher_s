<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['admin_id'])) { Redirect::to('index.php');}

 ?>


            <div class="card-body">
                <div class="card-title">
                  <h6 class="mr-2"><span>All General Users</span><small class="px-1"></small></h6>
                </div>
                <div class="e-table">
                    <div class="container">
                        <div class="main-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="card">
                                    <img src="../img/pattern-2-dark.png" alt="Cover" class="card-img-top">
                                    <div class="card-body text-center">
                                      <img src="../img/avatar.png" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                      <h5 class="card-title">Tendai Gara</h5>
                                      <p class="heading2">emailaddress@gmail.com</p>
                                      <p class="text-secondary user-status mb-1">UNVERIFIED</p>
                                      <p class="text-muted font-size-sm">21 Kumba kwake Road, Area D, Harare</p>
                                    </div>
                                    <div class="card-footer text-center">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button class="buttn" data-toggle="modal" data-target="#user-form-modal" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="delete" ><i class="fa fa-trash"></i></button></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="verify" ><i class="fa fa-check-circle"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="card">
                                    <img src="../img/pattern-2-dark.png" alt="Cover" class="card-img-top">
                                    <div class="card-body text-center">
                                      <img src="../img/avatar.png" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                      <h5 class="card-title">Hande Iwe</h5>
                                      <p class="heading2">emailaddress@gmail.com</p>
                                      <p class="text-secondary user-status mb-1">ACTIVE</p>
                                      <p class="text-muted font-size-sm">21 Kumba kwake Road, Area D, Harare</p>
                                    </div>
                                    <div class="card-footer text-center">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button class="buttn" data-toggle="modal" data-target="#user-form-modal" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="delete" ><i class="fa fa-trash"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="verify" ><i class="fa fa-check-circle"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="card">
                                    <img src="../img/pattern-2-dark.png" alt="Cover" class="card-img-top">
                                    <div class="card-body text-center">
                                      <img src="../img/avatar.png" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                      <h5 class="card-title">Kora Mukaka</h5>
                                      <p class="heading2">emailaddress@gmail.com</p>
                                      <p class="text-secondary user-status mb-1">ACTIVE</p>
                                      <p class="text-muted font-size-sm">21 Kumba kwake Road, Area D, Harare</p>
                                    </div>
                                    <div class="card-footer text-center">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button class="buttn" data-toggle="modal" data-target="#user-form-modal" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="delete" ><i class="fa fa-trash"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="verify" ><i class="fa fa-check-circle"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="card">
                                    <img src="../img/pattern-2-dark.png" alt="Cover" class="card-img-top">
                                    <div class="card-body text-center">
                                      <img src="../img/avatar.png" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                      <h5 class="card-title">Kendu Main</h5>
                                      <p class="heading2">emailaddress@gmail.com</p>
                                      <p class="text-secondary user-status mb-1">ACTIVE</p>
                                      <p class="text-muted font-size-sm">21 Kumba kwake Road, Area D, Harare</p>
                                    </div>
                                    <div class="card-footer text-center">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button class="buttn" data-toggle="modal" data-target="#user-form-modal" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="delete" ><i class="fa fa-trash"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="verify" ><i class="fa fa-check-circle"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="card">
                                    <img src="../img/pattern-2-dark.png" alt="Cover" class="card-img-top">
                                    <div class="card-body text-center">
                                      <img src="../img/avatar.png" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                      <h5 class="card-title">His Name</h5>
                                      <p class="heading2">emailaddress@gmail.com</p>
                                      <p class="text-secondary user-status mb-1">ACTIVE</p>
                                      <p class="text-muted font-size-sm">21 Kumba kwake Road, Area D, Harare</p>
                                    </div>
                                    <div class="card-footer text-center">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button class="buttn" data-toggle="modal" data-target="#user-form-modal" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="delete" ><i class="fa fa-trash"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="verify" ><i class="fa fa-check-circle"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="card">
                                    <img src="../img/pattern-2-dark.png" alt="Cover" class="card-img-top">
                                    <div class="card-body text-center">
                                      <img src="../img/avatar.png" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                      <h5 class="card-title">His Name</h5>
                                      <p class="heading2">emailaddress@gmail.com</p>
                                      <p class="text-secondary user-status mb-1">ACTIVE</p>
                                      <p class="text-muted font-size-sm">21 Kumba kwake Road, Area D, Harare</p>
                                    </div>
                                    <div class="card-footer text-center">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button class="buttn" data-toggle="modal" data-target="#user-form-modal" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="delete" ><i class="fa fa-trash"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="verify" ><i class="fa fa-check-circle"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="card">
                                    <img src="../img/pattern-2-dark.png" alt="Cover" class="card-img-top">
                                    <div class="card-body text-center">
                                      <img src="../img/avatar.png" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                      <h5 class="card-title">Johnso Johns</h5>
                                      <p class="heading2">emailaddress@gmail.com</p>
                                      <p class="text-secondary user-status mb-1">ACTIVE</p>
                                      <p class="text-muted font-size-sm">21 Kumba kwake Road, Area D, Harare</p>
                                    </div>
                                    <div class="card-footer text-center">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button class="buttn" data-toggle="modal" data-target="#user-form-modal" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="delete" ><i class="fa fa-trash"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="verify" ><i class="fa fa-check-circle"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="card">
                                    <img src="../img/pattern-2-dark.png" alt="Cover" class="card-img-top">
                                    <div class="card-body text-center">
                                      <img src="../img/avatar.png" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                      <h5 class="card-title">Inda Varsaw</h5>
                                      <p class="heading2">emailaddress@gmail.com</p>
                                      <p class="text-secondary user-status mb-1">ACTIVE</p>
                                      <p class="text-muted font-size-sm">21 Kumba kwake Road, Area D, Harare</p>
                                    </div>
                                    <div class="card-footer text-center">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button class="buttn" data-toggle="modal" data-target="#user-form-modal" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="delete" ><i class="fa fa-trash"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="verify" ><i class="fa fa-check-circle"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="card">
                                    <img src="../img/pattern-2-dark.png" alt="Cover" class="card-img-top">
                                    <div class="card-body text-center">
                                      <img src="../img/avatar.png" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                      <h5 class="card-title">Gara Cole</h5>
                                      <p class="heading2">emailaddress@gmail.com</p>
                                      <p class="text-secondary user-status mb-1">UNVERIFIED</p>
                                      <p class="text-muted font-size-sm">21 Kumba kwake Road, Area D, Harare</p>
                                    </div>
                                    <div class="card-footer text-center">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button class="buttn" data-toggle="modal" data-target="#user-form-modal" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="delete" ><i class="fa fa-trash"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="verify" ><i class="fa fa-check-circle"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                         </div>
                         <div class="d-flex justify-content-center">
                            <ul class="pagination mt-3 mb-0">
                            <li class="disabled page-item"><a href="#" class="page-link">‹</a></li>
                            <li class="active page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">4</a></li>
                            <li class="page-item"><a href="#" class="page-link">5</a></li>
                            <li class="page-item"><a href="#" class="page-link">›</a></li>
                            <li class="page-item"><a href="#" class="page-link">»</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
