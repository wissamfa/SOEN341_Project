import { NgModule } from '@angular/core';
import { CdkTableModule } from '@angular/cdk/table';
import { CdkAccordionModule } from '@angular/cdk/accordion';
import { A11yModule } from '@angular/cdk/a11y';
import { BidiModule } from '@angular/cdk/bidi';
import { OverlayModule } from '@angular/cdk/overlay';
import { PlatformModule } from '@angular/cdk/platform';
import { ObserversModule } from '@angular/cdk/observers';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { PortalModule } from '@angular/cdk/portal';

@NgModule({
  exports: [
    CdkTableModule,
    CdkAccordionModule,
    A11yModule,
    BidiModule,
    PlatformModule,
    OverlayModule,
    ObserversModule,
    PortalModule,
    FontAwesomeModule
  ]
})
export class MaterialModule { }
