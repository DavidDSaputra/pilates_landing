@extends('layoutsadmin.app')

@section('title', 'Activity Logs')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4 animate-fade-in-up">
            <div>
                <h1 class="text-2xl font-bold text-blue-400">Activity Logs</h1>
                <p class="text-sm theme-text-secondary mt-1">Monitor system activities and changes</p>
            </div>
        </div>

        <!-- Filters -->
        <div
            class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl shadow-lg p-6 mb-6 animate-fade-in-up delay-100">
            <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-semibold theme-text-secondary mb-2">Search</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="Search action, table, user..."
                            class="w-full px-4 py-2 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 transition theme-text-primary">
                    </div>

                    <!-- Action Filter -->
                    <div>
                        <label for="action" class="block text-sm font-semibold theme-text-secondary mb-2">Action</label>
                        <select id="action" name="action"
                            class="w-full px-4 py-2 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 transition theme-text-primary">
                            <option value="">All Actions</option>
                            @foreach($actions as $action)
                                <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                    {{ ucfirst($action) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- User Filter -->
                    <div>
                        <label for="user_id" class="block text-sm font-semibold theme-text-secondary mb-2">User</label>
                        <select id="user_id" name="user_id"
                            class="w-full px-4 py-2 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 transition theme-text-primary">
                            <option value="">All Users</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Table Filter -->
                    <div>
                        <label for="table" class="block text-sm font-semibold theme-text-secondary mb-2">Table</label>
                        <select id="table" name="table"
                            class="w-full px-4 py-2 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 transition theme-text-primary">
                            <option value="">All Tables</option>
                            @foreach($tables as $table)
                                <option value="{{ $table }}" {{ request('table') == $table ? 'selected' : '' }}>
                                    {{ $table }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date From -->
                    <div>
                        <label for="date_from" class="block text-sm font-semibold theme-text-secondary mb-2">Date
                            From</label>
                        <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}"
                            class="w-full px-4 py-2 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 transition theme-text-primary">
                    </div>

                    <!-- Date To -->
                    <div>
                        <label for="date_to" class="block text-sm font-semibold theme-text-secondary mb-2">Date To</label>
                        <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}"
                            class="w-full px-4 py-2 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 transition theme-text-primary">
                    </div>
                </div>

                <!-- Filter Buttons -->
                <div class="flex gap-3">
                    <button type="submit"
                        class="px-6 py-2 bg-gradient-primary hover:shadow-lg hover:shadow-blue-500/30 text-white rounded-lg transition-all duration-300">
                        <i class="fas fa-filter mr-2"></i>
                        Apply Filters
                    </button>
                    <a href="{{ route('admin.activity-logs.index') }}"
                        class="px-6 py-2 theme-bg-secondary theme-border border hover:border-blue-400 theme-text-primary rounded-lg transition-all duration-300">
                        <i class="fas fa-times mr-2"></i>
                        Clear Filters
                    </a>
                </div>

                <!-- Active Filters Display -->
                @if(request()->hasAny(['search', 'action', 'user_id', 'table', 'date_from', 'date_to']))
                    <div class="flex flex-wrap gap-2 pt-4 theme-border border-t border-dashed mt-4">
                        <span class="text-sm font-medium theme-text-secondary">Active Filters:</span>
                        @if(request('search'))
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-sm border border-blue-500/20">
                                Search: {{ request('search') }}
                            </span>
                        @endif
                        @if(request('action'))
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-sm border border-blue-500/20">
                                Action: {{ ucfirst(request('action')) }}
                            </span>
                        @endif
                        @if(request('user_id'))
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-sm border border-blue-500/20">
                                User: {{ $users->find(request('user_id'))->name ?? 'Unknown' }}
                            </span>
                        @endif
                        @if(request('table'))
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-sm border border-blue-500/20">
                                Table: {{ request('table') }}
                            </span>
                        @endif
                        @if(request('date_from'))
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-sm border border-blue-500/20">
                                From: {{ request('date_from') }}
                            </span>
                        @endif
                        @if(request('date_to'))
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-sm border border-blue-500/20">
                                To: {{ request('date_to') }}
                            </span>
                        @endif
                    </div>
                @endif
            </form>
        </div>

        <!-- Activity Logs Table -->
        <div
            class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl shadow-2xl overflow-hidden animate-fade-in-up delay-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y theme-divide">
                    <thead class="theme-bg-secondary">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-primary uppercase tracking-wider">
                                Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-primary uppercase tracking-wider">
                                User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-primary uppercase tracking-wider">
                                Action</th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-primary uppercase tracking-wider">
                                Table</th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-primary uppercase tracking-wider">
                                Details</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y theme-divide">
                        @forelse($logs as $log)
                            <tr class="hover:bg-blue-400/5 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm theme-text-secondary">
                                    <div>{{ $log->created_at->format('d M Y') }}</div>
                                    <div class="text-xs opacity-70">{{ $log->created_at->format('H:i:s') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 bg-blue-500/20 rounded-full flex items-center justify-center text-blue-400 font-bold text-xs theme-border border">
                                            {{ $log->user ? strtoupper(substr($log->user->name, 0, 2)) : 'SY' }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium theme-text-primary">
                                                {{ $log->user ? $log->user->name : 'System' }}
                                            </div>
                                            @if($log->user)
                                                <div class="text-xs theme-text-secondary">{{ $log->user->email }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $badgeColor = match ($log->action) {
                                            'created' => 'green',
                                            'updated' => 'blue',
                                            'deleted' => 'red',
                                            default => 'gray'
                                        };
                                        // Map simple colors to Tailwind classes for flexibility if needed, 
                                        // but straightforward interpolation works for simple cases.
                                        // For new theme consistency, verify classes exist or map them.
                                        $bgClass = "bg-{$badgeColor}-500/10";
                                        $textClass = "text-{$badgeColor}-400";
                                        $borderClass = "border-{$badgeColor}-500/20";
                                    @endphp
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $bgClass }} {{ $textClass }} border {{ $borderClass }}">
                                        {{ ucfirst($log->action) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm theme-text-secondary">
                                    {{ $log->table_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="showDetails('{{ $log->id }}')"
                                        class="text-blue-400 hover:text-blue-300 transition-colors">
                                        <i class="fas fa-eye mr-1"></i>
                                        View Details
                                    </button>

                                    <!-- Hidden Data for Modal -->
                                    <div id="log-data-{{ $log->id }}" class="hidden">
                                        <div class="old-data">{{ json_encode($log->old_data, JSON_PRETTY_PRINT) }}</div>
                                        <div class="new-data">{{ json_encode($log->new_data, JSON_PRETTY_PRINT) }}</div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center theme-text-secondary">
                                    <i class="fas fa-inbox text-4xl mb-3 opacity-20"></i>
                                    <p class="text-lg">No activity logs found</p>
                                    @if(request()->hasAny(['search', 'action', 'user_id', 'table', 'date_from', 'date_to']))
                                        <a href="{{ route('admin.activity-logs.index') }}"
                                            class="mt-2 inline-block text-blue-400 hover:text-blue-300">
                                            Clear filters to see all logs
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($logs->hasPages())
                <div class="px-6 py-4 theme-border border-t theme-bg-secondary">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div id="detailsModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-black/50 transition-opacity backdrop-blur-sm" aria-hidden="true"
                onclick="closeModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-gradient-card backdrop-blur-md theme-border border rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-bold text-blue-400 mb-4" id="modal-title">
                                Activity Details
                            </h3>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-semibold theme-text-secondary mb-2">Old Data</h4>
                                    <pre id="modalOldData"
                                        class="theme-bg-secondary p-3 rounded-lg text-xs overflow-auto max-h-96 theme-text-primary theme-border border font-mono"></pre>
                                </div>
                                <div>
                                    <h4 class="font-semibold theme-text-secondary mb-2">New Data</h4>
                                    <pre id="modalNewData"
                                        class="theme-bg-secondary p-3 rounded-lg text-xs overflow-auto max-h-96 theme-text-primary theme-border border font-mono"></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="theme-bg-secondary px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse theme-border border-t">
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-lg border theme-border shadow-sm px-4 py-2 bg-gradient-primary text-base font-medium text-white hover:shadow-lg focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-300"
                        onclick="closeModal()">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetails(id) {
            const oldData = document.querySelector(`#log-data-${id} .old-data`).textContent;
            const newData = document.querySelector(`#log-data-${id} .new-data`).textContent;

            document.getElementById('modalOldData').textContent = oldData !== 'null' ? oldData : 'N/A';
            document.getElementById('modalNewData').textContent = newData !== 'null' ? newData : 'N/A';

            document.getElementById('detailsModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('detailsModal').classList.add('hidden');
        }
    </script>
@endsection