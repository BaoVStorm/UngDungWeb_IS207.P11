import pandas as pd

load_attribute_id = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn\CSV\AllAttribute.csv"
df_id = pd.read_csv(load_attribute_id)

dic_id = {}

dataframe_header = ["POTID", "ATTID", "VALUE"]

for i in range(len(df_id)):
    dic_id[df_id["all_attribute"][i]] = df_id["id_attribute"][i]

input_path = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn\CSV\Pot_Attribute_.csv"

output_path = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn\CSV"

new_df = pd.DataFrame(dataframe_header)
df = pd.read_csv(input_path)
row_number = 0


for i in range(len(df)):
    for col in df:
        if col == "POTID":
            continue
        
        if not pd.isna(df[col][i]):
            new_df.at[row_number, "POTID"] = df["POTID"][i]
            new_df.at[row_number, "ATTID"] = dic_id[col]
            new_df.at[row_number, "VALUE"] = df[col][i]
            print(new_df["POTID"][row_number], new_df["ATTID"][row_number], new_df["VALUE"][row_number])
            row_number += 1

new_df.to_csv(output_path + rf"\Pot_Attribute1.csv", index=False, encoding="utf-8-sig")

print("Save successfully")