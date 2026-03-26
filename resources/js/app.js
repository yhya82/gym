import './echo'; 
import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);
window.Chart = Chart;
console.log('App loaded');