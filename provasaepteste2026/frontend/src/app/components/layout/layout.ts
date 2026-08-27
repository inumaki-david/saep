import { Component, EventEmitter, Input, Output } from '@angular/core';

@Component({
  selector: 'app-layout',
  standalone: false,
  styleUrl: './layout.css',
  templateUrl: './layout.html',
})
export class Layout {
  @Input() usuario = 'Administrador';
  @Output() logout = new EventEmitter<void>();
  @Output() sectionChange = new EventEmitter<string>();
  section = 'visao-geral';

  navegar(section: string): void {
    this.section = section;
    this.sectionChange.emit(section);
  }
}
