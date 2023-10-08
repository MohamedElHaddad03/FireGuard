import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { MapComponent } from '../map/map.component';
import { FooterToolBarComponent } from '../footer-tool-bar/footer-tool-bar.component';
import {  MenuController } from '@ionic/angular';

@Component({
  selector: 'app-main',
  templateUrl: './main.page.html',
  styleUrls: ['./main.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, MapComponent, FooterToolBarComponent]
})
export class MainPage implements OnInit {

  public selectedTab: string = 'Home';
  popup=false;

  openPopup(){
    this.popup=true;
  }
  closePopup(){
    this.popup=false;
  }

  confirmPos(){
    this.closePopup();
  }

  cancelPos(){
    this.closePopup();
  }
  openMenu(){
    this.menuCtrl.enable(true, 'home_menu');
    this.menuCtrl.open('home_menu');
  }
  constructor(private menuCtrl: MenuController) { }

  ngOnInit() {
  }

}
