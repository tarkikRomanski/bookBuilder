import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';

import { BookListComponent } from './book-list/book-list.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { BookItemComponent } from './book-item/book-item.component';
import { MatButtonModule, MatCardModule, MatListModule } from '@angular/material';
import { BookShowComponent } from './book-show/book-show.component';

@NgModule({
  declarations: [
    AppComponent,
    BookListComponent,
    BookItemComponent,
    BookShowComponent,
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    MatCardModule,
    MatListModule,
    MatButtonModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
