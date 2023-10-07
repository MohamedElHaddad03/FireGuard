import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import * as L from 'leaflet';

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.scss'],
  standalone: true,
})
export class MapComponent  implements OnInit {
  @ViewChild('map', { static: true }) mapElement!: ElementRef;

  private map!: L.Map;

  ngOnInit() {
    this.initializeMap();
  }

  private initializeMap() {
    this.map = L.map(this.mapElement.nativeElement).setView([35.7596, -5.8330], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors',
    }).addTo(this.map);

    const tangierCoordinates: [number, number] = [35.7596, -5.8330];
    this.addPin(tangierCoordinates);
  }

  private addPin(coordinates: [number, number]) {
    L.marker(coordinates, { zIndexOffset: 1000 }).addTo(this.map);
  }
  
  constructor() { }
}
