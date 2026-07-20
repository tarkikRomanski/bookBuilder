import { Component, EventEmitter, Input, Output } from '@angular/core';
import { BookModel } from '../../models/book.model';

@Component({
  selector: 'app-book-item',
  templateUrl: './book-item.component.html',
  styleUrls: ['./book-item.component.scss'],
  standalone: false
})
export class BookItemComponent {
  @Input() book!: BookModel;

  @Output() giveId = new EventEmitter<number>();
  @Output() toggleFavorite = new EventEmitter<number>();
  @Output() quickProgress = new EventEmitter<number>();

  getCorrectBase64(screen?: string): string {
    if (!screen) return '';
    if (screen.startsWith('assets/') || screen.startsWith('http://') || screen.startsWith('https://') || screen.startsWith('data:image')) {
      return screen;
    }
    return `data:image/jpeg;base64,${screen}`;
  }

  onCardClick(): void {
    if (this.book?.uid) {
      this.giveId.emit(this.book.uid);
    }
  }

  onFavoriteClick(event: MouseEvent): void {
    event.stopPropagation();
    if (this.book?.uid) {
      this.toggleFavorite.emit(this.book.uid);
    }
  }

  onQuickProgressClick(event: MouseEvent): void {
    event.stopPropagation();
    if (this.book?.uid) {
      this.quickProgress.emit(this.book.uid);
    }
  }
}
