import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2/dist/sweetalert2.all.js';
import toastr from 'toastr/build/toastr.min.js';
import Chart from 'chart.js/auto';
import $ from 'jquery';
import dt from 'datatables.net';

window.Alpine = Alpine;
window.Swal = Swal;
window.toastr = toastr;
window.Chart = Chart;
window.$ = window.jQuery = $;
dt(window, $);

Alpine.start();
