import { ApiCitizen } from '../../Api';
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
import { IonButton, IonIcon } from '@ionic/angular';



@Component({
  selector: 'app-chat',
  template: `
    <div >

      <ion-button style=" --background: #ec3d15; color:white;" class="add-button-container">
        <ion-icon name="add-circle-outline" class="add-button"></ion-icon> Add discussion
      </ion-button>

      <div class="scrollable-content">
        <ion-card *ngFor="let group of groups">
          <ion-card-header>
            <ion-card-title>{{ group.title }}</ion-card-title>
            <ion-card-subtitle>{{ group.content }}</ion-card-subtitle>
          </ion-card-header>

          <ion-card-content>
            {{ group.description }}
          </ion-card-content>

          <ion-button style=" --background: #ec3d15;" expand="block">Join Discussion</ion-button>
        </ion-card>
      </div>

      <div class="donate-button">
        <ion-button style=" --background: #ec3d15;" expand="block">
          <ion-icon name="wallet-outline" class="wallet-icon"></ion-icon> Donate here
        </ion-button>
      </div>

    </div>
  `,
  styleUrls: ['./main.page.scss'],
  standalone:true,
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
  ],

})
export class ChatComponent {
  groups: any[] = []; // Assuming groups is an array of objects

  async ngOnInit() {
    try {
      this.groups = await ApiCitizen.fetchChats();
    } catch (error) {
      console.error('Error fetching chats:', error);
    }
  }
}
