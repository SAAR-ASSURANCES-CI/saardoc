<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export des Documents</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 14px;
            color: #6b7280;
        }
        .filters {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f3f4f6;
            border-radius: 8px;
        }
        .filter-item {
            margin-bottom: 5px;
        }
        .filter-label {
            font-weight: bold;
            color: #374151;
        }
        .filter-value {
            color: #6b7280;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #2563eb;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #1d4ed8;
        }
        td {
            padding: 10px 8px;
            border: 1px solid #d1d5db;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .document-title {
            font-weight: bold;
            color: #1f2937;
        }
        .document-description {
            color: #6b7280;
            font-size: 11px;
            margin-top: 5px;
        }
        .document-type {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            display: inline-block;
        }
        .author {
            font-weight: bold;
            color: #374151;
        }
        .date {
            color: #6b7280;
        }
        .size {
            color: #059669;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #d1d5db;
            padding-top: 20px;
        }
        .page-number {
            text-align: right;
            font-size: 10px;
            color: #6b7280;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Export des Documents</div>
        <div class="subtitle">Système de Gestion Documentaire</div>
        <div class="subtitle">Exporté le : {{ $exportDate }}</div>
    </div>

    @if($search || $selectedType)
    <div class="filters">
        <div class="filter-item">
            <span class="filter-label">Filtres appliqués :</span>
        </div>
        @if($search)
        <div class="filter-item">
            <span class="filter-label">Recherche :</span>
            <span class="filter-value">{{ $search }}</span>
        </div>
        @endif
        @if($selectedType)
        <div class="filter-item">
            <span class="filter-label">Type :</span>
            <span class="filter-value">{{ $selectedType }}</span>
        </div>
        @endif
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Document</th>
                <th>Type</th>
                <th>Auteur</th>
                <th>Date de publication</th>
                <th>Taille</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>
                    <div class="document-title">{{ $document->titre }}</div>
                    @if($document->description)
                    <div class="document-description">{{ Str::limit($document->description, 100) }}</div>
                    @endif
                </td>
                <td>
                    <span class="document-type">{{ $document->type }}</span>
                </td>
                <td>
                    <span class="author">{{ $document->user->name ?? 'N/A' }}</span>
                </td>
                <td>
                    <div class="date">{{ $document->date_publication->format('d/m/Y') }}</div>
                    <div class="date" style="font-size: 10px;">{{ $document->date_publication->diffForHumans() }}</div>
                </td>
                <td>
                    <span class="size">{{ $document->taille_formatee ?? number_format($document->taille / 1024, 2) . ' KB' }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total des documents exportés : {{ $documents->count() }}</p>
        <p>Ce rapport a été généré automatiquement par le système</p>
    </div>

    <div class="page-number">
        Page 1
    </div>
</body>
</html>
