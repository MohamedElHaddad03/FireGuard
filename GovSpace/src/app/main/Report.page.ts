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
import { IonButton, IonIcon } from '@ionic/angular';



@Component({
  selector: 'app-report',
  template: `
  <div class="scrollable-content">
  <ion-card *ngFor="let report of reports">
    <ion-card-header>
      <ion-card-title>#{{ report.id }}</ion-card-title>
    </ion-card-header>
    <ion-card-content style="display: flex; justify-content: center;align-items: center;">
      {{ report.user.name }}
    </ion-card-content>
    <ion-card-content style="display: flex; justify-content: center;align-items: center;">
      {{ report.location.latitude }} , {{ report.location.longitude }}
    </ion-card-content>
    <div style="display: flex; align-items: center; justify-content: center; gap: 25px;">
      <ion-button  style=" --background: #0fb100;" expand="block">Approve</ion-button>
      <ion-button  style=" --background: #ec2315;" expand="block">Refuse</ion-button>
    </div>
  </ion-card>
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
export class ReportComponent {
  reports: any[] = []; // Assuming groups is an array of objects

  async ngOnInit() {
    try {
      this.reports = await ApiCitizen.fetchReports();
    } catch (error) {
      console.error('Error fetching chats:', error);
    }
  }
}
