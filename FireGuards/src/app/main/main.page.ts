import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { MapComponent } from '../map/map.component';
import { FooterToolBarComponent } from '../footer-tool-bar/footer-tool-bar.component';
import {  MenuController } from '@ionic/angular';
import { LocalNotifications } from '@capacitor/local-notifications';
import { Haptics } from '@capacitor/haptics';
import { GoogleChartsModule } from 'angular-google-charts';
import {ChatComponent} from './Chat.page';





@Component({
  selector: 'app-main',
  templateUrl: './main.page.html',
  styleUrls: ['./main.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, MapComponent, FooterToolBarComponent,GoogleChartsModule,ChatComponent]
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

  async triggerAlarm() {
    await Haptics.vibrate();

    const audio = new Audio();
    audio.src = '/src/assets/fire_alarm_at_factory_2.mp3';
    audio.volume = 0.5; // Set the volume to 50%
    audio.play();

    await LocalNotifications.schedule({
      notifications: [
        {
          title: 'Alarm Notification',
          body: "There's a fire in your region, please take caution and follow the instructions of the authorities",
          id: 2,
          schedule: { at: new Date(Date.now() + 1000) },
          sound: '/src/assets/fire_alarm_at_factory_2.mp3' // Set sound to null to prevent default notification sound
        },
      ],
    });
  }



  constructor(private menuCtrl: MenuController) { }

  ngOnInit() {
    LocalNotifications.requestPermissions();

  }

}
