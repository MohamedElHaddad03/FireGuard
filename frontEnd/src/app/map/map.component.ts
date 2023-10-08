import { Component, OnInit, ViewChild, ElementRef,Input } from '@angular/core';
import * as L from 'leaflet';
import 'leaflet-editable';

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.scss'],
  standalone: true,
})
export class MapComponent  implements OnInit {
  @ViewChild('map', { static: true }) mapElement!: ElementRef;
  @Input() showCircle: boolean = false;
  @Input() showpoligon: boolean = false;

  private map!: L.Map;

  ngOnInit() {
    this.initializeMap();
  }

  private initializeMap() {
    this.map = L.map('map').setView([35.7596, -5.8330], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors',
    }).addTo(this.map);

    const Coordinates: [number, number] = [35.7596, -5.8330];

    // Add a marker
    L.marker(Coordinates, { zIndexOffset: 1000, draggable: false }).addTo(this.map);

    if (this.showCircle) {
      // Add a circle
      const circle = L.circle(Coordinates, {
        color: 'red',
        fillColor: 'red',
        fillOpacity: 0.5,
        radius: 500, // Adjust the radius as needed (in meters)
      }).addTo(this.map);

      const circle1 = L.circle(Coordinates, {
        color: 'red',
        fillColor: 'red',
        fillOpacity: 0.5,
        radius: 1000, // Adjust the radius as needed (in meters)
      }).addTo(this.map);
    }
    

      /* if(this.showpoligon){
        // Add a polygon
        const polygon = L.polygon([
          [35.8096, -5.8430],
          [35.7590, -5.7955],
          [35.7585, -5.8340]
        ], {
          color: 'red',
          fillColor: 'red',
          fillOpacity: 0.5
        }).addTo(this.map);
      } */
  }
}
