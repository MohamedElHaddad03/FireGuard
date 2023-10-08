import { Component, OnInit, EventEmitter, Output } from '@angular/core';
import { IonIcon, IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { CommonModule } from '@angular/common';


@Component({
  selector: 'app-footer-tool-bar',
  templateUrl: './footer-tool-bar.component.html',
  styleUrls: ['./footer-tool-bar.component.scss'],
  standalone: true,
  imports:[IonicModule,CommonModule],
})
export class FooterToolBarComponent  implements OnInit {

  public activeTab: string = 'ReportsList'; 
   

  @Output() tabSelected = new EventEmitter<string>();

  gotoReportsList(): void{
    this.tabSelected.emit('ReportsList');
    this.activeTab = 'ReportsList';
    const Icon = document.querySelector('.reports-icon');
    // cast the icon element to IonIcon
    const icon = Icon as unknown as IonIcon;
    // change the icon name
      icon.name = 'file-tray-full';
    }  
  
  gotoStatistics(){
    this.tabSelected.emit('Statistics');
    this.activeTab = 'Statistics';
    const Icon = document.querySelector('.statistics-icon');
    // cast the icon element to IonIcon
    const icon = Icon as unknown as IonIcon;
    // change the icon name
      icon.name = 'stats-chart';
        
  }
  
  gotoEscapePlan(){
    this.tabSelected.emit('EscapePlan');
    this.activeTab = 'EscapePlan';
    const Icon = document.querySelector('.escape-icon');
    // cast the icon element to IonIcon
    const icon = Icon as unknown as IonIcon;
    // change the icon name
      icon.name = 'Document';
  }


  gotoCurrent(){
    this.tabSelected.emit('Current');
    this.activeTab = 'Current';
    const Icon = document.querySelector('.current-icon');
    // cast the icon element to IonIcon
    const icon = Icon as unknown as IonIcon;
    // change the icon name
      icon.name = 'videocam';
  }





  constructor(private router: Router) {}

  ngOnInit() {}

}
