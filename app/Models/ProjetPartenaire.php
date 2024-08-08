<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetPartenaire extends Model
{
    use HasFactory;
        // Indiquer le nom de la table si ce n'est pas la convention par défaut (projet_partenaires)
        protected $table = 'projets_partenaires';

        // Pas de clé primaire auto-incrémentée
        public $incrementing = false;
    
        // Définir les clés primaires composites
        protected $primaryKey = ['idP', 'idPa'];
    
        // Permettre l'utilisation de tableaux pour les clés primaires
        protected function setKeysForSaveQuery($query)
        {
            $keys = $this->getKeyName();
            if (!is_array($keys)) {
                return parent::setKeysForSaveQuery($query);
            }
    
            foreach ($keys as $key) {
                $query->where($key, '=', $this->getKeyForSaveQuery($key));
            }
    
            return $query;
        }
    
        protected function getKeyForSaveQuery($key = null)
        {
            if (is_null($key)) {
                $key = $this->getKeyName();
            }
    
            return $this->original[$key] ?? $this->getAttribute($key);
        }
    
        // Relations
        public function projet()
        {
            return $this->belongsTo(Projet::class);
        }
    
        public function partenaire()
        {
            return $this->belongsTo(Partenaire::class);
        }
}
