import { Component, EventEmitter, Input, Output } from '@angular/core';
import { BookModel } from '../../models/book.model';

@Component({
  selector: 'app-book-item',
  templateUrl: './book-item.component.html',
  styleUrls: [ './book-item.component.scss' ]
})
export class BookItemComponent {
  @Input() book: BookModel;

  @Output('updateProgress') updateProgressEmmiter = new EventEmitter<number>();

  updateProgress(progress: number) {
    this.updateProgressEmmiter.emit(progress);
  }
}
