<?php
namespace App\Traits;
trait CommonList{
    public function adminList($data = [],$page,$per_page){
        $returnHtml = '<table class="table table-bordered">
            <thead>
                <tr class="bg-dark">
                    <th class="text-white">Sl</th>
                    <th class="text-white">Name</th>
                    <th class="text-white">Email</th>
                    <th class="text-white">Action</th>
                </tr>
            </thead><tbody>';
            if(count($data) <= 0){
                $returnHtml .= '<tr><td colspan="4" class="text-center">'.$this->noDataFound().'</td></tr>';
                $returnHtml .= '</tbody></table>';
            }
            foreach($data as $key=>$d){
                $returnHtml .= '<tr>
                    <td>'.((($page-1)*$per_page)+$key+1).'</td>
                    <td>'.($d->name).'</td>
                    <td>'.($d->email).'</td>
                    <td>'.'<button onclick="edit('.$d->id.')" class="btn btn-warning btn-xs">Edit</button>'.'</td>
                </tr>';
            }

        $returnHtml .= '</tbody></table>';

        return $returnHtml;
    }

    public function teacherList($data = [],$page,$per_page){
        $returnHtml = '<table class="table table-bordered">
            <thead>
                <tr class="bg-dark">
                    <th class="text-white">Sl</th>
                    <th class="text-white">Name</th>
                    <th class="text-white">Email</th>
                    <th class="text-white">Designation</th>
                    <th class="text-white">Mobile</th>
                    <th class="text-white">Action</th>
                </tr>
            </thead><tbody>';
            if(count($data) <= 0){
                $returnHtml .= '<tr><td colspan="9" class="text-center">'.$this->noDataFound().'</td></tr>';
                $returnHtml .= '</tbody></table>';
            }
            foreach($data as $key=>$d){
                $returnHtml .= '<tr>
                    <td>'.((($page-1)*$per_page)+$key+1).'</td>
                    <td>'.($d->name).'</td>
                    <td>'.($d->email).'</td>
                    <td>'.(getTeacherDesignation($d->designation)).'</td>
                    <td>'.($d->mobile).'</td>
                    <td>'.'<button onclick="edit('.$d->id.')" class="btn btn-warning btn-xs">Edit</button>'.'</td>
                </tr>';
            }

        $returnHtml .= '</tbody></table>';

        return $returnHtml;
    }

    public function subjectList($data = [],$page,$per_page){
        $returnHtml = '<table class="table table-bordered">
            <thead>
                <tr class="bg-dark">
                    <th class="text-white">Sl</th>
                    <th class="text-white">Name</th>
                    <th class="text-white">Code</th>
                    <th class="text-white">Credit</th>
                    <th class="text-white">Description</th>
                    <th class="text-white">Action</th>
                </tr>
            </thead><tbody>';
            if(count($data) <= 0){
                $returnHtml .= '<tr><td colspan="8" class="text-center">'.$this->noDataFound().'</td></tr>';
                $returnHtml .= '</tbody></table>';
            }
            foreach($data as $key=>$d){
                $returnHtml .= '<tr>
                    <td>'.((($page-1)*$per_page)+$key+1).'</td>
                    <td>'.($d->name).'</td>
                    <td>'.($d->code).'</td>
                    <td>'.($d->credit).'</td>
                    <td>'.($d->description).'</td>
                    <td>'.'<button onclick="edit('.$d->id.')" class="btn btn-warning btn-xs">Edit</button>'.'</td>
                </tr>';
            }

        $returnHtml .= '</tbody></table>';

        return $returnHtml;
    }

    public function noDataFound(){
        return '<b>No Data Found</b>';
    }

}
