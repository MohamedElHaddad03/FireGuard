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

  public activeTab: string = 'Home'; 
   

  @Output() tabSelected = new EventEmitter<string>();

  gotoCom(): void{
    this.tabSelected.emit('Community');
    this.activeTab = 'Community';
    const Icon = document.querySelector('.community-icon');
    // cast the icon element to IonIcon
    const icon = Icon as unknown as IonIcon;
    // change the icon name
      icon.name = 'person';
      this.disactivate();
    }  
  
  gotoReport(){
    this.tabSelected.emit('Report');
    this.activeTab = 'Report';
    const Icon = document.querySelector('.report-icon');
    // cast the icon element to IonIcon
    const icon = Icon as unknown as IonIcon;
    // change the icon name
      icon.name = 'alert-circle';
      this.disactivate();
        
  }
  
  gotoHomeView(){
    this.tabSelected.emit('Home');
    this.activeTab = 'Home';
    const Icon = document.querySelector('.home-icon');
    // cast the icon element to IonIcon
    const icon = Icon as unknown as IonIcon;
    // change the icon name
      icon.name = 'home';
      this.disactivate();
  }

disactivate(){
if(this.activeTab==='Home'){
  const Icon = document.querySelector('.report-icon');
    const icon = Icon as unknown as IonIcon;
      icon.name = 'alert-circle-outline';

      const Icon1 = document.querySelector('.community-icon');
    const icon1 = Icon1 as unknown as IonIcon;
      icon1.name = 'person-outline';

}

if(this.activeTab==='Community'){
  const Icon = document.querySelector('.report-icon');
    const icon = Icon as unknown as IonIcon;
      icon.name = 'alert-circle-outline';

      const Icon2 = document.querySelector('.home-icon');
    const icon2 = Icon2 as unknown as IonIcon;
      icon2.name = 'home-outline';
}

if(this.activeTab==='Report'){
  const Icon = document.querySelector('.home-icon');
    const icon = Icon as unknown as IonIcon;
      icon.name = 'home-outline';

      const Icon1 = document.querySelector('.community-icon');
    const icon1 = Icon1 as unknown as IonIcon;
      icon1.name = 'person-outline';

      
}
}



  constructor(private router: Router) {}

  ngOnInit() {}

}
