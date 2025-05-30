@extends('layouts.app')

@section('title', 'Task Manager - Daftar Tugas')

@section('content')
<div class="bg-decoration"></div>
<div class="bg-decoration"></div>
<div class="bg-decoration"></div>
<div class="bg-decoration"></div>

<div class="container">
    <div class="header">
        <div class="header-content">
            <h1>Task Manager</h1>
            <p>Kelola tugas Anda dengan deadline dan prioritas</p>
        </div>
        <button class="add-task-btn" onclick="openModal('taskModal')">➕ Tambah Tugas</button>
    </div>

    <div class="main-content">
        <div class="task-list">
            <div class="filter-tabs">
                <div class="filter-tab {{ request('filter', 'all') === 'all' ? 'active' : '' }}" data-filter="all">Semua</div>
                <div class="filter-tab {{ request('filter') === 'pending' ? 'active' : '' }}" data-filter="pending">Aktif</div>
                <div class="filter-tab {{ request('filter') === 'completed' ? 'active' : '' }}" data-filter="completed">Selesai</div>
                <div class="filter-tab {{ request('filter') === 'overdue' ? 'active' : '' }}" data-filter="overdue">Terlambat</div>
            </div>

            <h2 class="section-title">Daftar Tugas</h2>
            
            <div id="taskContainer">
                @if($tasks->count() > 0)
                    @foreach($tasks as $task)
                        <div class="task-card {{ $task->completed ? 'completed' : '' }}" data-task-id="{{ $task->id }}">
                            <div class="task-header">
                                <div class="task-priority priority-{{ $task->priority ?? 'medium' }}">
                                    @switch($task->priority ?? 'medium')
                                        @case('high')
                                            🔥 Tinggi
                                            @break
                                        @case('low')
                                            🌱 Rendah
                                            @break
                                        @default
                                            ⚡ Sedang
                                    @endswitch
                                </div>
                                <div class="task-status">
                                    @if($task->completed)
                                        <span class="status-badge completed">✅ Selesai</span>
                                    @elseif($task->deadline && $task->deadline->isPast())
                                        <span class="status-badge overdue">⏰ Terlambat</span>
                                    @else
                                        <span class="status-badge pending">📝 Aktif</span>
                                    @endif
                                </div>
                            </div>

                            <div class="task-content">
                                <h3 class="task-title">
                                    <a href="{{ route('tasks.show', $task) }}" class="task-link">
                                        {{ $task->title }}
                                    </a>
                                </h3>
                                
                                @if($task->notes)
                                    <p class="task-notes">{{ Str::limit($task->notes, 100) }}</p>
                                @endif

                                @if($task->deadline)
                                    <div class="task-deadline">
                                        📅 Deadline: {{ $task->deadline->format('d M Y H:i') }}
                                    </div>
                                @endif

                                @if($task->subtasks && count($task->subtasks) > 0)
                                    <div class="task-subtasks">
                                        <small>{{ count(array_filter($task->subtasks, fn($st) => $st['completed'])) }}/{{ count($task->subtasks) }} sub-tugas selesai</small>
                                    </div>
                                @endif
                            </div>

                            <div class="task-actions">
                                <button class="action-btn complete-btn" onclick="toggleComplete({{ $task->id }})">
                                    {{ $task->completed ? '↩️' : '✅' }}
                                </button>
                                <button class="action-btn edit-btn" onclick="editTask({{ $task->id }})">
                                    ✏️
                                </button>
                                <button class="action-btn delete-btn" onclick="deleteTask({{ $task->id }})">
                                    🗑️
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">📝</div>
                        <h3>Belum ada tugas</h3>
                        <p>Tambahkan tugas pertama Anda untuk mulai berorganisasi!</p>
                        <button class="add-task-btn" onclick="openModal('taskModal')">➕ Tambah Tugas</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Task Modal -->
<div class="modal" id="taskModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="modalTitle">➕ Tambah Tugas Baru</h2>
            <button class="close-btn" onclick="closeModal('taskModal')">&times;</button>
        </div>
        
        <form id="taskForm" method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <input type="hidden" id="taskId" name="task_id">
            <input type="hidden" id="formMethod" name="_method" value="POST">
            
            <div class="form-group">
                <label class="form-label">Judul Tugas</label>
                <input type="text" class="form-input" id="taskTitle" name="title" placeholder="Masukkan judul tugas..." required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Prioritas</label>
                    <select class="form-select" id="taskPriority" name="priority">
                        <option value="high">🔥 Tinggi</option>
                        <option value="medium" selected>⚡ Sedang</option>
                        <option value="low">🌱 Rendah</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Deadline</label>
                    <input type="datetime-local" class="form-input" id="taskDeadline" name="deadline">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Catatan</label>
                <textarea class="form-textarea" id="taskNotes" name="notes" placeholder="Tambahkan catatan atau rincian tugas..."></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Sub-tugas (pisahkan dengan enter)</label>
                <textarea class="form-textarea" id="taskSubtasks" name="subtasks" placeholder="Sub-tugas 1&#10;Sub-tugas 2&#10;Sub-tugas 3"></textarea>
            </div>
            
            <button type="submit" class="submit-btn" id="submitBtn">✨ Tambah Tugas</button>
        </form>
    </div>
</div>

<script>
// Global variables
let editingTaskId = null;

// Modal functions
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
    document.body.style.overflow = 'auto';
    resetForm();
}

function resetForm() {
    document.getElementById('taskForm').reset();
    document.getElementById('taskId').value = '';
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('modalTitle').textContent = '➕ Tambah Tugas Baru';
    document.getElementById('submitBtn').textContent = '✨ Tambah Tugas';
    editingTaskId = null;
    
    // Reset form action
    document.getElementById('taskForm').action = "{{ route('tasks.store') }}";
}

// Task functions
function toggleComplete(taskId) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/tasks/${taskId}/toggle-complete`;
    form.innerHTML = '@csrf';
    document.body.appendChild(form);
    form.submit();
}

function editTask(taskId) {
    // Fetch task data and populate form
    fetch(`/tasks/${taskId}`)
        .then(response => response.json())
        .then(task => {
            editingTaskId = taskId;
            document.getElementById('taskId').value = taskId;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('taskTitle').value = task.title;
            document.getElementById('taskPriority').value = task.priority || 'medium';
            document.getElementById('taskNotes').value = task.notes || '';
            
            if (task.deadline) {
                const deadline = new Date(task.deadline);
                document.getElementById('taskDeadline').value = deadline.toISOString().slice(0, 16);
            }
            
            if (task.subtasks) {
                const subtasksText = task.subtasks.map(st => st.title).join('\n');
                document.getElementById('taskSubtasks').value = subtasksText;
            }
            
            document.getElementById('modalTitle').textContent = '✏️ Edit Tugas';
            document.getElementById('submitBtn').textContent = '💾 Update Tugas';
            document.getElementById('taskForm').action = `/tasks/${taskId}`;
            
            openModal('taskModal');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengambil data tugas');
        });
}

function deleteTask(taskId) {
    if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/tasks/${taskId}`;
        form.innerHTML = '@csrf @method("DELETE")';
        document.body.appendChild(form);
        form.submit();
    }
}

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterTabs = document.querySelectorAll('.filter-tab');
    
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const filter = this.dataset.filter;
            window.location.href = `{{ route('dashboard') }}?filter=${filter}`;
        });
    });
    
    // Close modal when clicking outside
    document.getElementById('taskModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal('taskModal');
        }
    });
    
    // Handle form submission
    document.getElementById('taskForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const method = document.getElementById('formMethod').value;
        const url = this.action;
        
        // Process subtasks
        const subtasksText = document.getElementById('taskSubtasks').value;
        if (subtasksText.trim()) {
            const subtasks = subtasksText.split('\n')
                .filter(line => line.trim())
                .map(title => ({ title: title.trim(), completed: false }));
            formData.set('subtasks', JSON.stringify(subtasks));
        }
        
        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan tugas');
        });
    });
});
</script>

<style>
/* Tambahan CSS untuk task cards */
.task-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border-left: 4px solid #3b82f6;
}

.task-card.completed {
    opacity: 0.7;
    border-left-color: #10b981;
}

.task-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.task-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.task-priority {
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 16px;
    font-weight: 600;
}

.priority-high { background: #fef2f2; color: #dc2626; }
.priority-medium { background: #fffbeb; color: #d97706; }
.priority-low { background: #f0fdf4; color: #16a34a; }

.status-badge {
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 16px;
    font-weight: 600;
}

.status-badge.completed { background: #f0fdf4; color: #16a34a; }
.status-badge.pending { background: #eff6ff; color: #2563eb; }
.status-badge.overdue { background: #fef2f2; color: #dc2626; }

.task-title {
    margin: 0 0 8px 0;
    font-size: 18px;
    font-weight: 600;
}

.task-link {
    text-decoration: none;
    color: #1f2937;
    transition: color 0.2s;
}

.task-link:hover {
    color: #3b82f6;
}

.task-notes {
    color: #6b7280;
    margin: 8px 0;
    line-height: 1.5;
}

.task-deadline, .task-subtasks {
    font-size: 14px;
    color: #6b7280;
    margin: 4px 0;
}

.task-actions {
    display: flex;
    gap: 8px;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid #f3f4f6;
}

.action-btn {
    background: none;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 8px 12px;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 14px;
}

.action-btn:hover {
    background: #f9fafb;
    border-color: #d1d5db;
}

.complete-btn:hover { background: #f0fdf4; border-color: #16a34a; }
.edit-btn:hover { background: #fffbeb; border-color: #d97706; }
.delete-btn:hover { background: #fef2f2; border-color: #dc2626; }

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6b7280;
}

.empty-icon {
    font-size: 48px;
    margin-bottom: 16px;
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.modal-content {
    background: white;
    border-radius: 12px;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .task-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
}
</style>
@endsection