import "./bootstrap";
import "laravel-datatables-vite";

import jQuery from "jquery";
window.$ = jQuery;

import toastr from "toastr";
window.toastr = toastr;

import swal from "sweetalert2";
window.Swal = swal;

import "../assets/js/adminlte.min";
import "../assets/js/validation";
import * as notif from "../assets/js/notif";
window.notif = notif;

import * as helper from "../assets/js/halper";
window.helper = helper;

import "jquery-ui/dist/jquery-ui";

import "../backend/categories";
import "../backend/products";
import "../backend/discounts";
